<!doctype html>
<?php
$stylesheetPath = kirby()->roots()->assets() . DS . 'css' . DS . 'site-2026-rebuild.css';
$stylesheetVersion = is_file($stylesheetPath) ? filemtime($stylesheetPath) : time();

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

$metaSource = $metaFieldValue($page, array('description', 'summary', 'lede', 'intro', 'text'));
$metaDescription = $metaExcerpt($metaSource, (string)$site->description());
$metaTitle = $page->isHomePage() ? (string)$site->title() : (string)$page->title() . ' | ' . (string)$site->title();
$metaUrl = $page->url();
$metaImage = url('assets/images/og.png');
$metaType = in_array((string)$page->template(), array('article', 'project')) ? 'article' : 'website';
?>
<html lang="<?= $site->language() ? $site->language()->code() : 'en' ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= html($metaDescription) ?>">
  <title><?= html($metaTitle) ?></title>
  <link rel="canonical" href="<?= html($metaUrl) ?>">
  <meta property="og:site_name" content="<?= $site->title()->html() ?>">
  <meta property="og:type" content="<?= html($metaType) ?>">
  <meta property="og:title" content="<?= html($metaTitle) ?>">
  <meta property="og:description" content="<?= html($metaDescription) ?>">
  <meta property="og:url" content="<?= html($metaUrl) ?>">
  <meta property="og:image" content="<?= html($metaImage) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= html($metaTitle) ?>">
  <meta name="twitter:description" content="<?= html($metaDescription) ?>">
  <meta name="twitter:image" content="<?= html($metaImage) ?>">
  <link rel="manifest" href="<?= url('site.webmanifest') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="<?= url('assets/fonts/CabinetGrotesk-Variable.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <style>
      @font-face {
        font-family: 'Cabinet';
        src: url('<?= url('assets/fonts/CabinetGrotesk-Variable.woff2') ?>') format('woff2');
        font-weight: 100 900;
        font-display: swap;
        font-style: normal;
      }
    </style>  
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= url('assets/css/site-2026-rebuild.css') ?>?v=<?= $stylesheetVersion ?>">
</head>
<body id="canvas" class="<?= $page->isHomePage() ? 'is-home' : 'is-subpage' ?> template-<?= $page->template() ?>">
<a class="skip-link" href="#main-content">Skip to content</a>

<?php if($page->isHomePage()): ?>
  <header class="hero" role="banner">
    <div class="hero__top">
      <a class="hero__logo hero__logo--white" href="<?= url() ?>" rel="home" aria-label="<?= $site->title()->html() ?> home">
        <?php snippet('logo') ?>
      </a>
    </div>
    <h1 class="hero__headline">I help teams build clear, usable digital products, and grow the design capability needed to sustain them.</h1>
      <div class="hero__more">
        <img src="<?= url('assets/images/jra-avatar-sm.jpg') ?>" alt="" width="150" height="150" loading="lazy" decoding="async">
        <a href="<?= url('is') ?>" data-hover-tone="identity">Who I am</a>
        <span>&</span>
        <a href="<?= url('does') ?>" data-hover-tone="work">What I do</a>
        <span class="hero__more-chevron" aria-hidden="true">›</span>           
      </div> 
  </header>
<?php else: ?>
  <header class="header" role="banner">
    <div class="header-shell">
      <div class="header-rail">
        <a class="header-logo" href="<?= url() ?>" rel="home" aria-label="<?= $site->title()->html() ?> home">
          <span class="logo"><?php snippet('logo') ?></span>
        </a>
        <?php if(function_exists('page_section_context') && $section = page_section_context($page)): ?>
          <span class="header-subnav" href="<?= $section['url'] ?>">/<?= html($section['slug']) ?></span>
        <?php endif ?>
      </div>
    </div>
  </header>
<?php endif ?>

<main id="main-content">
  <div id="container" class="<?= $page->isHomePage() ? 'mug-home' : $page->uid() ?>">
