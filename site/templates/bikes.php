<?php snippet('header') ?>

<div class="wrap-fluid">

    <article class="content-page bikes-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>

    </article>
</div>

<section class="wrap-full bike-grid bikes-grid" aria-label="Bikes">
    <?php foreach($page->children()->visible() as $subitem): ?>
      <article class="bike-card">
        <?php if($image = $subitem->image()): ?>
          <a class="bike-card__media" href="<?= $subitem->url() ?>">
            <img src="<?= $image->url() ?>" alt="<?= $subitem->title()->html() ?>" loading="lazy" decoding="async" />
          </a>
        <?php endif; ?>
        <div class="bike-card__body">
          <h3><a href="<?= $subitem->url() ?>"><?= $subitem->title()->html() ?></a></h3>
          <?php if($subitem->text()->isNotEmpty()): ?>
            <p><?= $subitem->text()->excerpt(150) ?></p>
          <?php endif ?>
        </div>
      </article>
    <?php endforeach ?>
</section>

<?php if($page->text2()->isNotEmpty()): ?>
<div class="wrap-fluid">
    <article class="content-page">
        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text2(), $page) : $page->text2()->kirbytext() ?>
        </div>
    </article>
</div>
<?php endif ?>

<?php snippet('footer') ?>
