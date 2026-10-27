<?php snippet('header') ?>

<div class="wrap-fluid">
    <article class="work-page">
        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

        <div class="text work-intro">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>
    </article>
</div>

<div class="wrap-full work-grid-wrap">
    <section class="work-grid" aria-label="Case studies">
        <?php foreach($page->children()->visible()->filterBy('template', 'project') as $subitem): ?>
            <?php
              $coverFilename = trim((string)$subitem->coverimage()->value());
              $coverImage = $coverFilename !== '' ? $subitem->image($coverFilename) : null;
              if(!$coverImage) $coverImage = $subitem->image();
            ?>
            <a class="work-card" href="<?= $subitem->url() ?>">
                <span class="work-card__media<?php e(!$coverImage, ' work-card__media--empty') ?>">
                    <?php if($coverImage): ?>
                        <?php snippet('responsive-image', array(
                          'image' => $coverImage,
                          'alt' => '',
                          'sizes' => '(min-width: 760px) 46vw, 94vw',
                          'widths' => array(480, 720, 960, 1280)
                        )) ?>
                    <?php else: ?>
                        <span class="work-card__monogram" aria-hidden="true"><?= $subitem->title()->html() ?></span>
                    <?php endif ?>
                </span>
                <span class="work-card__caption">
                    <span class="work-card__title"><?= $subitem->title()->html() ?></span>
                    <span class="work-card__arrow" aria-hidden="true">&rarr;</span>
                </span>
            </a>
        <?php endforeach ?>
    </section>
    <?php foreach($page->children()->visible() as $subitem): ?>
        <?php if($subitem->template() != 'project'): ?>
            <p class="work-grid-more"><a href="<?= $subitem->url() ?>"><?= $subitem->title()->html() ?> &rarr;</a></p>
        <?php endif ?>
    <?php endforeach ?>
</div>

<?php snippet('footer') ?>
