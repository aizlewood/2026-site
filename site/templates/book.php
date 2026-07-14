<?php snippet('header') ?>

<?php
  $coverFilename = trim($page->bookimage()->value());
  $coverImage = $coverFilename !== '' ? $page->image($coverFilename) : null;
  if(!$coverImage && $page->image()) {
    $coverImage = $page->image();
  }
  $bookLink = trim($page->link()->value());
?>

<div class="wrap-fluid book-page">
  <a class="back-link" href="<?= url('reads') ?>">&larr; Reading</a>

  <article class="book-detail">
    <?php if($coverImage): ?>
      <figure class="book-detail__cover">
        <img src="<?= $coverImage->url() ?>" alt="<?= $page->title()->html() ?>" loading="eager" decoding="async">
      </figure>
    <?php endif ?>

    <div class="book-detail__body">
      <h1><?= $page->title()->html() ?></h1>
      <?php if($page->author()->isNotEmpty()): ?>
        <p class="book-detail__author"><?= $page->author()->html() ?></p>
      <?php endif ?>
      <?php if($page->text()->isNotEmpty()): ?>
        <div class="text">
          <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>
      <?php endif ?>
      <?php if($bookLink !== ''): ?>
        <p><a href="<?= html($bookLink) ?>">View book &rarr;</a></p>
      <?php endif ?>
    </div>
  </article>
</div>

<?php snippet('footer') ?>
