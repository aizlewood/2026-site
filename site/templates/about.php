<?php snippet('header') ?>

<div class="wrap-fluid">

    <article class="content-page about-page project-content">

        <header class="about-page__header">
            <h1><?= $page->title()->html() ?></h1>
            
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
        
        <div class="text about-page__outside">
            <?= function_exists('render_rich_text') ? render_rich_text($page->outside(), $page) : $page->outside()->kirbytext() ?>
        </div>
    </article>
</div>

<?php snippet('footer') ?>
