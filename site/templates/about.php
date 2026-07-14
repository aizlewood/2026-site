<?php snippet('header') ?>

<div class="wrap-fluid">

    <article class="content-page about-page project-content">

        <header class="about-page__header">
            <h1><?= $page->title()->html() ?></h1>

            <?php if($image = $page->image()): ?>
            <figure class="breakout">
                <img class="" src="<?= $image->url() ?>" alt="<?= $page->title()->html() ?>" decoding="async">
            </figure>
            <?php endif ?>    

            
            <div class="about-page__intro">
                <?= function_exists('render_rich_text') ? render_rich_text($page->intro(), $page) : $page->intro()->kirbytext() ?>
            </div>
       
        </header>
 
        <?php snippet('two-column-section', [
            'left' => $page->profile_left(),
            'right' => $page->profile_right(),
            'class' => 'about-page__profile',
            'theme' => 'dark',
            'label' => 'Professional profile',
            'aside' => $page->status(),
            'asideClass' => 'current-status',
            'asideLabel' => 'Current role',
            'asideBrandSrc' => url('/content/1-is/asquared-logo-m-invert.png'),
            'asideBrandAlt' => 'ASquared',
        ]) ?>
        
        <section class="client-logos" aria-label="Selected organisations">
          <?php foreach([
            ['3M.svg', '3M'],
            ['nordea.png', 'Nordea'],
            ['prh.png', 'Penguin Random House'],
            ['pearson.png', 'Pearson'],
            ['nbcu.png', 'NBCUniversal'],
            ['time.png', 'Time'],
            ['codeforamerica.png', 'Code for America'],
            ['lmr.png', 'Link My Ride'],
            ['bnb.png', 'Butternut Box'],
            ['virginatlantic.png', 'Virgin Atlantic'],
          ] as [$filename, $name]): ?>
            <?php if($logo = $page->image($filename)): ?>
              <div class="client-logo">
                <img src="<?= $logo->url() ?>" alt="<?= html($name) ?>" loading="lazy" decoding="async">HELLO
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </section>

        <div class="text about-page__outside">
            <?= function_exists('render_rich_text') ? render_rich_text($page->outside(), $page) : $page->outside()->kirbytext() ?>
        </div>
    </article>
</div>

<div class="wrap-fluid">
<hr class="measure-rule" />

    <?php snippet('blog-next-prev', ['flip' => true]) ?>

<hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
