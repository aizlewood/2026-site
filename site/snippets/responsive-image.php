<?php
$image = isset($image) ? $image : null;
if(!$image) return;

$alt = isset($alt) ? $alt : '';
$class = isset($class) ? trim($class) : '';
$sizes = isset($sizes) && trim($sizes) !== '' ? trim($sizes) : '100vw';
$loading = isset($loading) ? trim($loading) : 'lazy';
$decoding = isset($decoding) ? trim($decoding) : 'async';
$fetchpriority = isset($fetchpriority) ? trim($fetchpriority) : '';
$quality = isset($quality) ? (int)$quality : 82;
$widths = isset($widths) && is_array($widths) ? $widths : array(320, 640, 960, 1280, 1600);

$extension = method_exists($image, 'extension') ? strtolower($image->extension()) : '';
$originalWidth = method_exists($image, 'width') ? (int)$image->width() : 0;
$originalHeight = method_exists($image, 'height') ? (int)$image->height() : 0;
$canThumb = $originalWidth > 0 && !in_array($extension, array('svg', 'gif'));
$srcset = array();
$src = $image->url();

if($canThumb) {
  $generatedThumb = function($targetWidth) use ($image, $originalWidth, $originalHeight, $extension, $quality) {
    if(!class_exists('Thumb')) return null;

    $targetHeight = $originalWidth > 0 ? (int)round(($originalHeight / $originalWidth) * $targetWidth) : 0;
    $pageId = method_exists($image, 'page') && $image->page() ? $image->page()->id() : 'assets';
    $pagePath = trim($pageId, '/');
    $pagePath = $pagePath === '' ? 'site' : $pagePath;
    $pagePath = implode('/', array_map(function($segment) {
      return preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($segment));
    }, explode('/', $pagePath)));

    $safeName = method_exists($image, 'name') ? f::safeName($image->name()) : 'image';
    $filename = $safeName . '-' . $targetWidth . 'x' . $targetHeight . '-q' . $quality . '.' . $extension;
    $relativeDir = '_generated/' . $pagePath;
    $root = kirby()->roots()->thumbs() . DS . str_replace('/', DS, $relativeDir);
    $url = kirby()->urls()->thumbs() . '/' . $relativeDir;
    $targetRoot = $root . DS . $filename;
    $targetUrl = $url . '/' . $filename;

    if(is_file($targetRoot) && filemtime($targetRoot) >= $image->modified()) {
      return $targetUrl;
    }

    try {
      $thumb = new Thumb($image, array(
        'width' => $targetWidth,
        'quality' => $quality,
        'driver' => 'gd',
        'bin' => 'convert',
        'destination' => function() use ($targetRoot, $targetUrl) {
          return new Obj(array(
            'root' => $targetRoot,
            'url' => $targetUrl
          ));
        }
      ));

      if(is_file($targetRoot)) {
        return $targetUrl;
      }
    } catch(Exception $e) {
      return null;
    }

    return null;
  };

  $filteredWidths = array();
  foreach($widths as $candidateWidth) {
    $candidateWidth = (int)$candidateWidth;
    if($candidateWidth > 0 && $candidateWidth <= $originalWidth) {
      $filteredWidths[] = $candidateWidth;
    }
  }

  if(empty($filteredWidths)) {
    $filteredWidths[] = $originalWidth;
  }

  $filteredWidths = array_values(array_unique($filteredWidths));
  sort($filteredWidths);

  foreach($filteredWidths as $targetWidth) {
    $thumbUrl = $generatedThumb($targetWidth);
    if($thumbUrl !== null) {
      $srcset[] = $thumbUrl . ' ' . $targetWidth . 'w';
      $src = $thumbUrl;
    }
  }
}

$attrs = array(
  'src="' . html($src) . '"',
  'alt="' . html($alt) . '"'
);

if($class !== '') $attrs[] = 'class="' . html($class) . '"';
if(!empty($srcset)) $attrs[] = 'srcset="' . html(implode(', ', $srcset)) . '"';
if(!empty($srcset)) $attrs[] = 'sizes="' . html($sizes) . '"';
if($originalWidth > 0) $attrs[] = 'width="' . $originalWidth . '"';
if($originalHeight > 0) $attrs[] = 'height="' . $originalHeight . '"';
if($loading !== '') $attrs[] = 'loading="' . html($loading) . '"';
if($decoding !== '') $attrs[] = 'decoding="' . html($decoding) . '"';
if($fetchpriority !== '') $attrs[] = 'fetchpriority="' . html($fetchpriority) . '"';
?>
<img <?= implode(' ', $attrs) ?>>
