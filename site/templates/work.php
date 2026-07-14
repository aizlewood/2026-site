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

<div class="wrap-fluid work-slats-wrap">
    <article class="article index">
        <section class="work-slats" aria-label="Case studies">
            <?php foreach($page->children()->visible() as $subitem): ?>
                <a class="work-slat" href="<?= $subitem->url() ?>">
                    <span class="work-slat__title"><?= $subitem->title()->html() ?></span>
                    <span class="work-slat__arrow" aria-hidden="true">&rarr;</span>
                </a>
            <?php endforeach ?>
        </section>
    </article>
</div>

<div class="wrap-fluid">
<hr class="measure-rule" />

    <?php snippet('blog-next-prev', ['flip' => true]) ?>

<hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
