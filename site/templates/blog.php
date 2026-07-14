<?php snippet('header') ?>

<div class="wrap-fluid">
    <article>
        <header>
            <?php if(param('tag')): ?>
                <?php $tag = urldecode(param('tag')); ?>
                <h1 class="tag__header">Articles tagged with “<mark><strong><?= html($tag) ?></strong></mark>”</h1>
            <?php else: ?>
                <h1><?= $page->title()->html() ?></h1>
            <?php endif; ?>
        </header>

        <?php if(!param('tag')): ?>
          <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>
        <?php endif; ?>

        <?php if(!param('tag')): ?>
            <div class="intro text">
                <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
            </div>
        <?php endif; ?>
    </article>
</div>

<hr class="measure-rule" />

<section class="wrap-fluid blog-index">
<?php if(param('tag')): ?>
    <?php snippet('tag-listing-no-tags') ?>
<?php else: ?>
    <?php snippet('listing') ?>
<?php endif; ?>
</section>

<?php snippet('footer') ?>
