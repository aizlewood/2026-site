<?php snippet('header') ?>

<div class="wrap-fluid">

    <article class="content-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>

    <div class="items">
        <?php foreach($page->children()->visible() as $subitem): ?>

          <div class="subitem">
            <?php if($image = $subitem->image()): ?>
              <figure>
                <?php snippet('responsive-image', array(
                  'image' => $image,
                  'alt' => $subitem->title()->html(),
                  'sizes' => '(min-width: 64rem) 33vw, 100vw',
                  'widths' => array(320, 640, 960)
                )) ?>
              </figure>
              <?php endif; ?>
              <h4><?= $subitem->title()->html() ?></h4>
              <div class="text"><?= function_exists('render_rich_text') ? render_rich_text($subitem->text(), $subitem) : $subitem->text()->kirbytext() ?></div>
          </div>

        <?php endforeach ?>
    </div>

    </article>

    <hr class="measure-rule" />

      <?php snippet('blog-next-prev', ['flip' => true]) ?>

    <hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
