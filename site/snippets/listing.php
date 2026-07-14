<?php
  $articles = page('writes')->children()->visible()->sortBy('feeddate', 'desc', 'date', 'desc')->paginate(25);
?>
<section class="listing-feed">
  <?php if($articles->count()): ?>
    <?php foreach($articles as $article): ?>
      <?php snippet('feed-slat', array('page' => $article, 'class' => 'feed-slat--list', 'showBadge' => false, 'showSummary' => true, 'showDate' => true)); ?>
    <?php endforeach ?>

    <?php if ($articles->pagination()->hasPages()): ?>
      <nav class="pagination" aria-label="Writing pagination">
        <?php if ($articles->pagination()->hasNextPage()): ?>
          <a class="prev" href="<?= $articles->pagination()->nextPageURL() ?>">← Older articles</a>
        <?php endif ?>
        <?php if ($articles->pagination()->hasPrevPage()): ?>
          <a class="next" href="<?= $articles->pagination()->prevPageURL() ?>">Newer articles →</a>
        <?php endif ?>
      </nav>
    <?php endif ?>
  <?php else: ?>
    <p>This blog does not contain any articles yet.</p>
  <?php endif ?>
</section>
