<?php
$metaFieldValue = function($page, $fields) {
  foreach ((array)$fields as $field) {
    $value = trim((string)$page->$field()->value());
    if ($value !== '') {
      return $value;
    }
  }
  return '';
};

$metaExcerpt = function($value, $fallback = '') {
  $text = trim(strip_tags(kirbytext($value)));
  $text = preg_replace('/\s+/', ' ', $text);
  if ($text === '') {
    $text = $fallback;
  }
  if (function_exists('mb_strlen') && function_exists('mb_substr') && mb_strlen($text, 'UTF-8') > 155) {
    return rtrim(mb_substr($text, 0, 152, 'UTF-8')) . '...';
  }
  if (strlen($text) > 155) {
    return rtrim(substr($text, 0, 152)) . '...';
  }
  return $text;
};

$metaImageFromContent = function($page) {
  $coverFilename = trim((string)$page->coverimage()->value());
  if ($coverFilename !== '' && $image = $page->image($coverFilename)) {
    return $image;
  }

  $rawText = (string)$page->text()->value();
  if ($rawText !== '' && preg_match('/\(\s*image:\s*([^\s\)]+)/i', $rawText, $match)) {
    $filename = trim($match[1]);
    if ($filename !== '' && $image = $page->image($filename)) {
      return $image;
    }
  }

  return null;
};

$metaSource = $metaFieldValue($page, array('description', 'summary', 'lede', 'intro', 'text'));
$metaDescription = $metaExcerpt($metaSource, (string)$site->description());
$metaTitle = $page->isHomePage() ? (string)$site->title() : (string)$page->title() . ' | ' . (string)$site->title();
$metaUrl = $page->url();
$metaImageFile = $metaImageFromContent($page);
$metaImage = $metaImageFile ? $metaImageFile->url() : url('assets/images/og.png');
$metaImageWidth = $metaImageFile && method_exists($metaImageFile, 'width') ? $metaImageFile->width() : 1200;
$metaImageHeight = $metaImageFile && method_exists($metaImageFile, 'height') ? $metaImageFile->height() : 630;
$metaType = in_array((string)$page->template(), array('article', 'project')) ? 'article' : 'website';
?>
  <meta name="description" content="<?= html($metaDescription) ?>">
  <title><?= html($metaTitle) ?></title>
  <link rel="canonical" href="<?= html($metaUrl) ?>">
  <link rel="icon" href="<?= url('favicon.png') ?>" type="image/png">
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
  <link rel="apple-touch-icon" href="<?= url('apple-touch-icon.png') ?>">
  <meta property="og:site_name" content="<?= $site->title()->html() ?>">
  <meta property="og:type" content="<?= html($metaType) ?>">
  <meta property="og:title" content="<?= html($metaTitle) ?>">
  <meta property="og:description" content="<?= html($metaDescription) ?>">
  <meta property="og:url" content="<?= html($metaUrl) ?>">
  <meta property="og:image" content="<?= html($metaImage) ?>">
  <meta property="og:image:secure_url" content="<?= html($metaImage) ?>">
  <meta property="og:image:width" content="<?= html($metaImageWidth) ?>">
  <meta property="og:image:height" content="<?= html($metaImageHeight) ?>">
  <meta property="og:image:alt" content="<?= html($metaTitle) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= html($metaTitle) ?>">
  <meta name="twitter:description" content="<?= html($metaDescription) ?>">
  <meta name="twitter:image" content="<?= html($metaImage) ?>">
  <meta name="twitter:image:alt" content="<?= html($metaTitle) ?>">
  <link rel="manifest" href="<?= url('site.webmanifest') ?>">
