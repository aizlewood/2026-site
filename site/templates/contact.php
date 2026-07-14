<?php snippet('header') ?>

<div class="wrap-fluid">
  <article class="content-page contact-page">
    <header>
      <h1><?= $page->title()->html() ?></h1>
    </header>

    <div class="text">
      <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
    </div>
  </article>
</div>

<?php snippet('footer') ?>
