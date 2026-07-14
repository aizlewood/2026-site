<?php $articles = $page->site()->pages()->children()->visible()->filterBy('tags', param('tag'), ',')->sortBy('feeddate', 'desc', 'date', 'desc')->paginate(50); ?>
<section class="listing-feed">
  <?php if($articles->count()): ?>
    <?php foreach($articles as $article): ?>
      <?php snippet('feed-slat-no-tags', array('page' => $article, 'class' => 'feed-slat--list', 'showBadge' => false, 'showSummary' => true, 'showDate' => true)); ?>
    <?php endforeach ?>
  <?php else: ?>
    <p>No items found for this tag.</p>
  <?php endif ?>
</section>
