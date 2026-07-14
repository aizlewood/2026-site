<?php snippet('header') ?>

<div class="wrap-fluid">
  <article class="content-page">
    <header>
      <h1><?= $page->title()->html() ?></h1>
    </header>

    <div class="text">
      <?= render_rich_text($page->text(), $page) ?>
    </div>
  </article>
</div>

<?php snippet('footer') ?>
