<?php snippet('header') ?>

<div class="wrap-fluid">

    <article class="content-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => true, 'showDate' => true)); ?>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>        

    </article>
</div>



<div class="wrap-full">

    <article class="article index">

    <div class="items">
        <?php foreach($page->children()->visible() as $subitem): ?>

          <div class="subitem">
              <h3><a href="<?= $subitem->url() ?>" class=""><?= $subitem->title()->html() ?></a> &rarr;</h3>
          </div>

        <?php endforeach ?>
    </div>
    
    <hr class="measure-rule" />

    </article>
</div>


<div class="wrap-full">

    <article class="article index">

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text2(), $page) : $page->text2()->kirbytext() ?>
        </div>

    <hr class="measure-rule" />
    </article>
</div>


<div class="wrap-fluid">

    <article class="article index">


    <?php snippet('next-page') ?>

    <hr class="measure-rule" />
    </article>
</div>

<?php snippet('footer') ?>
