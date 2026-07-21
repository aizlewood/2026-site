<?php snippet('header') ?>

<div class="wrap-fluid">

      <a class="project-back" href="<?= url('did') ?>">&larr; All Work</a>
      <hr class="measure-rule project-nav-separator" />

    <article class="content-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

    </article>      

</div>    
<div class="wrap-full">

    <article class="content-page">

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

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

    </article>
</div>

<?php snippet('footer') ?>
