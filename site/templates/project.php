<?php snippet('header') ?>

<div class="wrap-fluid">

      <a class="project-back" href="<?= url('did') ?>">&larr; All Work</a>
      <hr class="measure-rule project-nav-separator" />
      
    <article class="project-detail">

        <header>
            <p class="project-subtitle">
              <span class="project-subtitle-value"><?php echo $page->title()->html() ?></span>
            </p>
            <h1><?php echo $page->lede()->html() ?></h1>
        </header>

        <?php if($image = $page->image()): ?>
        <figure class="full-bleed">
            <?php snippet('responsive-image', array(
              'image' => $image,
              'alt' => $page->title()->html(),
              'loading' => 'eager',
              'fetchpriority' => 'high',
              'sizes' => '100vw',
              'widths' => array(640, 960, 1280, 1600, 2000)
            )) ?>
        </figure>
        <?php endif ?>        

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

          <details class="project-meta-disclosure">
            <summary>Project details</summary>
            <ul class="meta" aria-label="Project meta">
              <li><span class="meta-label"><abbr title="How Might We">HMW</abbr></span><span class="meta-value"><?php echo $page->summary()->html() ?></span></li>
              <li><span class="meta-label">Sector</span><span class="meta-value"><?php echo $page->sector()->html() ?></span></li>
              <li><span class="meta-label">Role</span><span class="meta-value"><?php echo $page->role()->html() ?></span></li>
              <li><span class="meta-label">Agency</span><span class="meta-value"><?php echo $page->with()->html() ?></span></li>
              <!-- <li><span class="meta-label">When</span><span class="meta-value"><?php echo $page->year()->html() ?></span></li> -->
<?php if($page->website() != ''): ?>
              <li><span class="meta-label">Link</span><span class="meta-value"><a href="<?php echo $page->website()->html() ?>">See it live &rarr;</a></span></li>
<?php endif ?>
            </ul>
          </details>

          <section class="project-content">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
          </section>

    </article>

    <hr class="measure-rule" />

          <?php snippet('blog-next-prev', ['flip' => true]) ?>

    <hr class="measure-rule" />    

  </div>

    <?php snippet('footer') ?>
