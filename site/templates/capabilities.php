<?php snippet('header') ?>

<div class="wrap-fluid">
    <article class="capabilities-page">
        <header class="capabilities-page__header">
            <h1 class="capabilities-page__title"><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => true, 'showDate' => false)); ?>

        <?php if(!$page->text()->empty()): ?>
        <div class="capabilities-page__introduction">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>
        <?php endif ?>

        <div class="capabilities-page__list">
            <?php foreach($page->children()->visible() as $capability): ?>
            <article class="capabilities-page__item">
                <div class="capability__card">
                    <a class="work-slat" href="<?= $capability->url() ?>">
                        <span class="work-slat__title"><?= $capability->title()->html() ?></span>
                        <span class="work-slat__arrow" aria-hidden="true">&rarr;</span>
                    </a>
            </article>
            <?php endforeach ?>
        </div>
    </article>
</div>

<?php snippet('footer') ?>
