<?php
$landing = new DOMDocument();
$previousErrors = libxml_use_internal_errors(true);
$landing->loadHTML(file_get_contents($page->root() . DS . 'landing.html'));
libxml_clear_errors();
libxml_use_internal_errors($previousErrors);
$xpath = new DOMXPath($landing);

// Keep the imported landing page intact and add the site's navigation and contact destination.
$main = $landing->getElementsByTagName('main')->item(0);
$main->setAttribute('id', 'main-content');
$main->setAttribute('tabindex', '-1');
foreach ($xpath->query('//section[@id="interest"]//a') as $link) {
  if ($link->getAttribute('href') === '#') {
    $link->setAttribute('href', url('contacts'));
  }
}

foreach (array('header', 'footer') as $tag) {
  $container = $landing->getElementsByTagName($tag)->item(0);
  $nav = $landing->createElement('nav');
  $nav->setAttribute('class', 'arlo-return');
  $nav->setAttribute('aria-label', 'Main site');
  $link = $landing->createElement('a');
  $link->setAttribute('href', url() . '#home-feed-list');
  $arrow = $landing->createElement('span', html_entity_decode('&larr;', ENT_QUOTES, 'UTF-8'));
  $arrow->setAttribute('aria-hidden', 'true');
  $link->appendChild($arrow);
  $link->appendChild($landing->createTextNode(" Back to Jon's feed"));
  $nav->appendChild($link);
  $container->appendChild($nav);
}

$landingHtml = '';
foreach ($landing->getElementsByTagName('body')->item(0)->childNodes as $node) {
  $landingHtml .= $landing->saveHTML($node);
}
$assetsRoot = kirby()->roots()->assets() . DS . 'css' . DS;
?>
<!doctype html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php snippet('head-meta') ?>
  <link rel="stylesheet" href="<?= url('assets/css/arlo-source.css') ?>?v=<?= filemtime($assetsRoot . 'arlo-source.css') ?>">
  <link rel="stylesheet" href="<?= url('assets/css/arlo.css') ?>?v=<?= filemtime($assetsRoot . 'arlo.css') ?>">
</head>
<body class="arlo-page">
  <a class="arlo-skip" href="#main-content">Skip to content</a>
  <?= $landingHtml ?>
</body>
</html>
