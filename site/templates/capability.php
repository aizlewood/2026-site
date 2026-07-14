<?php snippet('header') ?>

<div class="wrap-fluid">
    <article class="capability-page">
        <nav class="capability-page__navigation" aria-label="Capability navigation">
            <a class="project-back" href="<?= $page->parent()->url() ?>">&larr; All <?= $page->parent()->title()->html() ?></a>
            <hr class="measure-rule project-nav-separator" />
        </nav>

        <header class="capability-page__header">
            <h1 class="capability-page__title"><?= $page->title()->html() ?></h1>        
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

        <?php if($image = $page->image()): ?>
        <figure class="capability-page__media">
            <img class="capability-page__image" src="<?= $image->url() ?>" alt="<?= $page->title()->html() ?>" decoding="async">
        </figure>
        <?php endif ?>

        <section class="capability-page__content text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </section>
    </article>
</div>

<?php snippet('footer') ?>
