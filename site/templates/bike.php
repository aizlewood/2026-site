<?php snippet('header') ?>

<div class="wrap-fluid bike-page">

    <a class="project-back" href="<?= url('bikes') ?>">&larr; All Bikes</a>
    <hr class="measure-rule project-nav-separator" />    

    <article class="article article--bike">
      <header>
        <h1><?= $page->title()->html() ?></h1>
      </header>

      <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

      <?php if($image = $page->image()): ?>
        <figure class="bike-hero">
          <a class="bike-hero-link" href="<?= $image->url() ?>">
            <?php snippet('responsive-image', array(
              'image' => $image,
              'alt' => $page->title()->html(),
              'class' => 'bike',
              'loading' => 'eager',
              'fetchpriority' => 'high',
              'sizes' => '(min-width: 72rem) 72rem, 100vw',
              'widths' => array(640, 960, 1280, 1600, 2000)
            )) ?>
          </a>
        </figure>
      <?php endif ?>

      <div class="text">
        <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
      </div>
    </article>

    <section class="bike-spec text" aria-label="Bike specification">
        <h4>Frameset</h4>
        <ul>
            <li><strong>frame</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->frame(), $page) : $page->frame()->kirbytext() ?></li>
            <li><strong>fork</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->fork(), $page) : $page->fork()->kirbytext() ?></li>
        </ul>

        <h4>Wheels</h4>
        <ul>
            <li><strong>wheels</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->wheels(), $page) : $page->wheels()->kirbytext() ?></li>
            <li><strong>tyres</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->tyres(), $page) : $page->tyres()->kirbytext() ?></li>
            <li><strong>rotors</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->rotors(), $page) : $page->rotors()->kirbytext() ?></li>
        </ul>

        <h4>Drivetrain</h4>
        <ul>
            <li><strong>shifters</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->shifters(), $page) : $page->shifters()->kirbytext() ?></li>
            <li><strong>rear mech</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->rearmech(), $page) : $page->rearmech()->kirbytext() ?></li>
            <li><strong>front mech</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->frontmech(), $page) : $page->frontmech()->kirbytext() ?></li>
            <li><strong>crank</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->crank(), $page) : $page->crank()->kirbytext() ?></li>
            <li><strong>bottom bracket</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->bottombracket(), $page) : $page->bottombracket()->kirbytext() ?></li>
            <li><strong>cassette</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->cassette(), $page) : $page->cassette()->kirbytext() ?></li>
            <li><strong>chain</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->chain(), $page) : $page->chain()->kirbytext() ?></li>
        </ul>

        <h4>Components</h4>
        <ul>
            <li><strong>saddle</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->saddle(), $page) : $page->saddle()->kirbytext() ?></li>
            <li><strong>seatpost</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->seatpost(), $page) : $page->seatpost()->kirbytext() ?></li>
            <li><strong>handlebar</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->handlebar(), $page) : $page->handlebar()->kirbytext() ?></li>
            <li><strong>grips or bartape</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->grips(), $page) : $page->grips()->kirbytext() ?></li>
            <li><strong>stem</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->stem(), $page) : $page->stem()->kirbytext() ?></li>
            <li><strong>headset</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->headset(), $page) : $page->headset()->kirbytext() ?></li>
            <li><strong>brake set</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->brakes(), $page) : $page->brakes()->kirbytext() ?></li>
            <li><strong>pedals</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->pedals(), $page) : $page->pedals()->kirbytext() ?></li>
        </ul>

        <h4>Size & Weight</h4>
        <ul>
            <li><strong>Size</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->size(), $page) : $page->size()->kirbytext() ?></li>          
            <li><strong>Weight (approx)</strong> <?= function_exists('render_rich_text') ? render_rich_text($page->weight(), $page) : $page->weight()->kirbytext() ?></li>            
        </ul>
    </section> 

    <hr class="measure-rule" />
      <?php snippet('blog-next-prev', ['flip' => true]) ?>
    <hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
