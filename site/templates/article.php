<?php snippet('header') ?>

<div class="wrap-fluid article-page">

      <a class="project-back" href="<?= url('writes') ?>">&larr; All Articles</a>
      <hr class="measure-rule project-nav-separator" /> 
      
    <article class="article article--post">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>

        <?php $articleTags = str::split($page->tags()); ?>
        <?php if(!empty($articleTags)): ?>
          <hr class="measure-rule" />

          <section class="post-tags" aria-label="Filed under">
            <p class="post-tags__label">Filed under</p>
            <nav class="tags" aria-label="Article tags">
              <?php foreach($articleTags as $tag): ?>
                <a href="<?= url('writes/tag:' . urlencode($tag)) ?>">#<?= html($tag) ?></a>
              <?php endforeach ?>             
            </nav>        
          </section>

          <section class="post-tags" aria-label="Written on">
            <p class="post-tags__label">Written on</p>
            <nav class="tags" aria-label="Datetime">
             <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => true)); ?>
             
            </nav>        
          </section>          
        <?php endif; ?>

    </article>

    <hr class="measure-rule" />

      <?php snippet('blog-next-prev', ['flip' => true]) ?>

    <hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
