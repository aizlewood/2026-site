<?php snippet('header') ?>
<?php $books = $page->children()->sortBy('title', 'asc'); ?>

<div class="wrap-full reads-page">

    <article class="content-page">

        <header>
            <h1><?= $page->title()->html() ?></h1>
        </header>

        <?php snippet('entry-meta', array('page' => $page, 'showBadge' => true, 'showDate' => true)); ?>

        <div class="text">
            <?= function_exists('render_rich_text') ? render_rich_text($page->text(), $page) : $page->text()->kirbytext() ?>
        </div>

    </article>

    <section class="reads-library" aria-label="Books">
      <?php if($books->count()): ?>
      <ul class="reads-grid">
        <?php foreach($books as $book): ?>
          <?php
            $coverFilename = trim($book->bookimage()->value());
            $coverImage = null;
            if($coverFilename !== '') {
              $coverImage = $book->image($coverFilename);
            }
            if(!$coverImage && $book->image()) {
              $coverImage = $book->image();
            }
          ?>
          <?php $bookLink = trim($book->link()->value()); ?>
          <li class="reads-card read-card">
              <?php if($coverImage): ?>
              <figure class="reads-cover read-card__cover">
                <?php if($bookLink !== ''): ?>
                <a href="<?= html($bookLink) ?>" class="reads-cover-link">
                  <?php snippet('responsive-image', array(
                    'image' => $coverImage,
                    'alt' => $book->title()->html(),
                    'sizes' => '(min-width: 64rem) 14rem, 45vw',
                    'widths' => array(180, 280, 420, 560)
                  )) ?>
                </a>
                <?php else: ?>
                  <?php snippet('responsive-image', array(
                    'image' => $coverImage,
                    'alt' => $book->title()->html(),
                    'sizes' => '(min-width: 64rem) 14rem, 45vw',
                    'widths' => array(180, 280, 420, 560)
                  )) ?>
                <?php endif ?>
              </figure>
              <?php endif ?>
              <h3 class="reads-title"><?= $book->title()->html() ?></h3>
              <p class="reads-author read-card__author"><?= $book->author()->html() ?></p>
          </li>
        <?php endforeach ?>
      </ul>
      <?php else: ?>
      <p>No books published yet.</p>
      <?php endif ?>
    </section>

    <hr class="measure-rule" />

    <?php snippet('next-page') ?>

    <hr class="measure-rule" />
</div>

<?php snippet('footer') ?>
