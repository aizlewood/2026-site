<?php snippet('header') ?>
<?php
$feedItems = function_exists('feed_pages') ? feed_pages() : array();
$initialLimit = 50;
?>
<section class="home-feed" id="home-feed-list" data-feed-list aria-label="Latest updates" aria-live="polite">
  <h2>Feed</h2>
  <?php if(!empty($feedItems)): ?>
    <?php foreach($feedItems as $index => $item): ?>
      <?php snippet('feed-slat-no-tags', array(
        'page' => $item,
        'showBadge' => true,
        'showSummary' => false,
        'showDate' => true,
        'hidden' => $index >= $initialLimit
      )) ?>
    <?php endforeach ?>
    <?php if(count($feedItems) > $initialLimit): ?>
      <div class="home-feed__more-wrap">
        <button class="home-feed__more" type="button" data-feed-load-more data-page-size="<?= $initialLimit ?>" aria-controls="home-feed-list">Load more</button>
      </div>
    <?php endif ?>
  <?php else: ?>
    <div class="text"><p>No feed items are currently published.</p></div>
  <?php endif ?>
</section>
<?php snippet('footer') ?>
