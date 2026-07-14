<?php snippet('header') ?>

<div class="wrap-fluid">
  <article class="content-page error-page">
    <header>
      <h1><?= $page->title()->html() ?></h1>
    </header>

    <?php if($page->intro()->isNotEmpty()): ?>
      <div class="text">
        <p class="p-lede"><?= $page->intro()->html() ?></p>
      </div>
    <?php endif ?>

    <div class="text">
      <?= render_rich_text($page->text(), $page) ?>
    </div>
  </article>
</div>

<?php snippet('footer') ?>
