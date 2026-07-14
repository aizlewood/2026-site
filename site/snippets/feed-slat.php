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
$classes = trim('feed-slat ' . $extraClass);
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
  <?php endif ?>
       
  <?php $articleTags = str::split($page->tags()); ?>
  <?php if(!empty($articleTags)): ?>
    <section class="feed-slat__tags post-tags" aria-label="Filed under">
      <p class="post-tags__label">Filed under</p>
            <nav class="tags" aria-label="Article tags">
              <?php foreach($articleTags as $tag): ?>
                <a href="<?= url('writes/tag:' . urlencode($tag)) ?>">#<?= html($tag) ?></a>
              <?php endforeach ?>     
      </nav>
      </section>

          <section class="datetime post-tags" aria-label="Written on">
            <p class="post-tags__label">Written on</p>
            <nav class="tags" aria-label="Datetime">
             <?php snippet('entry-meta', array('page' => $page, 'showBadge' => false, 'showDate' => true)); ?>
  <?php endif; ?>  
  
</article>
