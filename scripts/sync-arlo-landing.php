<?php
// Export the Arlo source into deployable files; production needs no sibling checkout.
if (PHP_SAPI !== 'cli') {
  http_response_code(404);
  exit;
}

$root = dirname(__DIR__);
$source = isset($argv[1]) ? rtrim($argv[1], '/') : dirname($root) . '/Arlo/docs/landing-content';
$html = @file_get_contents($source . '/index.html');
$css = @file_get_contents($source . '/styles.css');
if ($html === false || $css === false || trim($css) === '') {
  fwrite(STDERR, "Could not read Arlo's index.html and styles.css from " . $source . "\n");
  exit(1);
}

$document = new DOMDocument();
libxml_use_internal_errors(true);
$document->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXPath($document);
if ($xpath->query('//body/header')->length !== 1 ||
    $xpath->query('//body/main')->length !== 1 ||
    $xpath->query('//body/footer')->length !== 1 ||
    $xpath->query('//section[@id="interest"]//a')->length === 0) {
  fwrite(STDERR, "Arlo's landing structure has changed; check the site template before importing.\n");
  exit(1);
}

$exports = array(
  $root . '/content/8-arlo/landing.html' => $html,
  $root . '/assets/css/arlo-source.css' => $css
);
foreach ($exports as $path => $contents) {
  if (file_put_contents($path, $contents) === false) {
    fwrite(STDERR, 'Could not write ' . $path . "\n");
    exit(1);
  }
}
fwrite(STDOUT, "Refreshed Arlo's landing page and CSS from " . $source . "\n");
