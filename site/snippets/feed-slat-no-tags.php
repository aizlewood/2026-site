<?php
$item = isset($page) ? $page : null;
if(!$item) return;

$showBadge = isset($showBadge) ? $showBadge : true;
$showSummary = isset($showSummary) ? $showSummary : false;
$showDate = isset($showDate) ? $showDate : true;
$hidden = isset($hidden) ? (bool)$hidden : false;
$extraClass = isset($class) ? trim($class) : '';

$badge = function_exists('page_badge_context') ? page_badge_context($item) : null;
$badgeSlug = $badge && isset($badge['slug']) ? $badge['slug'] : '';
$palette = $badge && isset($badge['palette']) ? $badge['palette'] : '';
$timestamp = function_exists('page_feed_timestamp') ? page_feed_timestamp($item) : null;
$excerpt = function_exists('page_feed_excerpt') ? page_feed_excerpt($item, 200) : $item->text()->excerpt(200);
$classes = trim('feed-slat home ' . $extraClass);
?>
<article class="<?= html($classes) ?>"<?= $hidden ? ' hidden data-feed-hidden' : '' ?>>
  <?php if($showBadge && $badge): ?>
    <div class="feed-slat__badge">
      <span class="badge badge--<?= html($palette) ?> feed-slat__tag feed-slat__tag--<?= html($badgeSlug) ?>">
        <?= html($badge['label']) ?>
      </span>
    </div>
  <?php endif ?>

  <h3 class="feed-slat__title"><a href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></h3>

  <?php if($showSummary && $excerpt): ?>
    <div class="feed-slat__summary">
      <p><?= html($excerpt) ?></p>
    </div>
    
  <?php endif; ?>  
  
   <?php if($showDate && $timestamp): ?>
    <p class="feed-slat__year feed-slat__date"><time datetime="<?= date('Y-m-d', $timestamp) ?>"><?= date('Y', $timestamp) ?></time></p>
  <?php endif ?>
</article>
