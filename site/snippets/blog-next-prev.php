
<?php if($page->hasNextVisible() || $page->hasPrevVisible()): ?>
  <nav class="pagination pagination--postnav" aria-label="Post navigation">

    <?php if($page->hasPrevVisible()): ?>
      <a class="pagination__item pagination__item--prev" href="<?= $page->prevVisible()->url() ?>" rel="prev" title="<?= $page->prevVisible()->title()->html() ?>">
        <span class="pagination__label">&larr; Previous</span>
        <span class="pagination__title"><?= $page->prevVisible()->title()->html() ?></span>
      </a>
    <?php endif ?>

    <?php if($page->hasNextVisible()): ?>
      <a class="pagination__item pagination__item--next" href="<?= $page->nextVisible()->url() ?>" rel="next" title="<?= $page->nextVisible()->title()->html() ?>">
        <span class="pagination__label">Next &rarr;</span>
        <span class="pagination__title"><?= $page->nextVisible()->title()->html() ?></span>
      </a>
    <?php endif ?>

  </nav>
<?php endif ?>
