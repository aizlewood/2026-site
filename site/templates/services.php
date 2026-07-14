<?php snippet('header') ?>
<?php
  $services = $page->children()->visible()->filterBy('intendedTemplate', '!=', 'capabilities');
  $capabilities = $page->find('capabilities');
  $capabilityPages = $capabilities ? $capabilities->children()->visible() : null;
  $carouselCards = [];
  $serviceCards = [];
  $capabilityCards = [];

  foreach($services as $service) {
    $serviceCards[] = $service;
  }

  if($capabilityPages) {
    foreach($capabilityPages as $capability) {
      $capabilityCards[] = $capability;
    }
  }

  $hasCapabilities = count($capabilityCards) > 0;
  $carouselCardCount = max(count($serviceCards), count($capabilityCards));

  for($index = 0; $index < $carouselCardCount; $index++) {
    if(isset($serviceCards[$index])) {
      $carouselCards[] = ['type' => 'service', 'page' => $serviceCards[$index]];
    }

    if(isset($capabilityCards[$index])) {
      $carouselCards[] = ['type' => 'capability', 'page' => $capabilityCards[$index]];
    }
  }
?>

<div class="wrap-fluid">

    <article class="content-page services-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => false)); ?>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>

    </article>

</div>

<?php if(count($carouselCards)): ?>
<section class="services-carousel" aria-labelledby="services-carousel-title" data-card-carousel>
    <div class="services-carousel__header">
        <div>
            <h2 id="services-carousel-title" class="services-carousel__title">
                <?= $hasCapabilities ? $capabilities->title()->html() : 'Services' ?>
            </h2>
            <?php if($hasCapabilities && !$capabilities->text()->empty()): ?>
            <div class="services-carousel__introduction">
                <?= function_exists('render_rich_text') ? render_rich_text($capabilities->text(), $capabilities) : $capabilities->text()->kirbytext() ?>
            </div>
            <?php endif ?>
        </div>

        <div class="services-carousel__controls" data-carousel-controls hidden>
            <button class="services-carousel__button" type="button" data-carousel-previous aria-label="Show previous card">
                <span aria-hidden="true">&larr;</span>
            </button>
            <button class="services-carousel__button" type="button" data-carousel-next aria-label="Show next card">
                <span aria-hidden="true">&rarr;</span>
            </button>
        </div>
    </div>

    <div class="services-carousel__track" data-carousel-track tabindex="0" aria-label="Services and leadership capabilities">
        <?php foreach($carouselCards as $card): ?>
            <?php if($card['type'] === 'service'): ?>
            <article class="service-card services-carousel__card services-carousel__card--service">
                <h2><?= $card['page']->title()->html() ?></h2>
                <div class="text service-copy"><?= function_exists('render_rich_text') ? render_rich_text($card['page']->text(), $card['page']) : $card['page']->text()->kirbytext() ?></div>
            </article>
            <?php else: ?>
            <article class="service-card services-carousel__card services-carousel__card--capability">
                <a class="services-carousel__card-link" href="<?= $card['page']->url() ?>">
                    <h2><?= $card['page']->title()->html() ?></h2>
                    <?php if($card['page']->text()->isNotEmpty()): ?>
                    <p class="services-carousel__card-lede"><?= $card['page']->text()->excerpt(180) ?></p>
                    <?php endif ?>
                    <span class="services-carousel__card-action">View capability <span aria-hidden="true">&rarr;</span></span>
                </a>
            </article>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<div class="wrap-fluid">

    <article class="article index">

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text2(), $page) : $page->text2()->kirbytext() ?>
        </div>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text3(), $page) : $page->text3()->kirbytext() ?>
        </div>

    </article>

    <hr class="measure-rule" />

      <?php snippet('blog-next-prev', ['flip' => true]) ?>

    <hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
