<?php
  $showBadge = isset($showBadge) ? (bool)$showBadge : true;
  $showDate = isset($showDate) ? (bool)$showDate : true;
  $badge = function_exists('page_badge_context') ? page_badge_context($page) : null;
  $timestamp = function_exists('page_feed_timestamp') ? page_feed_timestamp($page) : time();
  $dateLabel = date('F jS, Y', $timestamp);
?>
<div class="entry-meta">
  <?php if($showBadge && $badge): ?>
    <div class="entry-meta__badge">
      <span class="badge badge--<?= html($badge['palette']) ?>"><?= html($badge['label']) ?></span>
    </div>
  <?php endif; ?>

  <?php if($showDate): ?>
                  <p class="entry-meta__date">
                      <time datetime="<?= date('c', $timestamp) ?>"><?= html($dateLabel) ?></time>
                  </p>
                <?php endif; ?>
</div>
