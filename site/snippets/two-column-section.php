<?php
$left = isset($left) ? $left : null;
$right = isset($right) ? $right : null;
$class = isset($class) ? trim($class) : '';
$theme = isset($theme) ? trim($theme) : 'dark';
$label = isset($label) ? trim($label) : '';
$aside = isset($aside) ? $aside : null;
$asideClass = isset($asideClass) ? trim($asideClass) : '';
$asideLabel = isset($asideLabel) ? trim($asideLabel) : '';
$asideBrandSrc = isset($asideBrandSrc) ? trim($asideBrandSrc) : '';
$asideBrandAlt = isset($asideBrandAlt) ? trim($asideBrandAlt) : '';

$leftHasContent = $left && method_exists($left, 'isNotEmpty') ? $left->isNotEmpty() : trim((string)$left) !== '';
$rightHasContent = $right && method_exists($right, 'isNotEmpty') ? $right->isNotEmpty() : trim((string)$right) !== '';
$asideHasContent = $aside && method_exists($aside, 'isNotEmpty') ? $aside->isNotEmpty() : trim((string)$aside) !== '';

if(!$leftHasContent && !$rightHasContent && !$asideHasContent) {
  return;
}

$layoutClass = $leftHasContent && $rightHasContent ? 'two-column-section--split' : 'two-column-section--single';
$sectionClass = trim('two-column-section ' . $layoutClass . ' two-column-section--' . $theme . ' ' . $class);
$asideClasses = trim('two-column-section__aside ' . $asideClass);
$renderColumn = function($field, $page) {
  return function_exists('render_rich_text') ? render_rich_text($field, $page) : $field->kirbytext();
};
?>

<section class="<?= html($sectionClass) ?>"<?php if($label !== ''): ?> aria-label="<?= html($label) ?>"<?php endif ?>>
  <div class="two-column-section__inner">
    <?php if($leftHasContent): ?>
      <div class="two-column-section__column">
        <?= $renderColumn($left, $page) ?>
      </div>
    <?php endif ?>

    <?php if($rightHasContent): ?>
      <div class="two-column-section__column">
        <?= $renderColumn($right, $page) ?>
      </div>
    <?php endif ?>
  </div>

  <?php if($asideHasContent): ?>
    <aside class="<?= html($asideClasses) ?>"<?php if($asideLabel !== ''): ?> aria-label="<?= html($asideLabel) ?>"<?php endif ?>>
      <?php if($asideBrandSrc !== ''): ?>
        <strong class="current-status__brand"><img src="<?= html($asideBrandSrc) ?>" alt="<?= html($asideBrandAlt) ?>" loading="lazy" decoding="async"></strong>
      <?php endif ?>
      <?= $renderColumn($aside, $page) ?>
    </aside>
  <?php endif ?>
</section>
