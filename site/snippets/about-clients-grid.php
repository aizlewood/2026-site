<?php if(isset($clients) && $clients->count()): ?>
<section class="about-clients" aria-label="Client logos">
  <ul class="about-clients__grid">
    <?php $renderedCount = 0; ?>
    <?php foreach($clients as $client): ?>
      <?php
        $logo = $page->image($client->logo()->value());
        if(!$logo) continue;
        $renderedCount++;
        $name = $client->name()->or('Client')->html();
        $url = trim($client->url()->value());
      ?>
      <li class="about-clients__item">
        <?php if($url !== ''): ?>
          <a href="<?= html($url) ?>" class="about-clients__link" target="_blank" rel="noopener">
            <?php snippet('responsive-image', array(
              'image' => $logo,
              'alt' => $name,
              'sizes' => '10rem',
              'widths' => array(160, 320)
            )) ?>
          </a>
        <?php else: ?>
          <span class="about-clients__link">
            <?php snippet('responsive-image', array(
              'image' => $logo,
              'alt' => $name,
              'sizes' => '10rem',
              'widths' => array(160, 320)
            )) ?>
          </span>
        <?php endif ?>
      </li>
    <?php endforeach ?>

    <?php
      // Add invisible filler cells so divider geometry stays correct
      // regardless of content count across breakpoints.
      $smallCols = 2;
      $largeCols = 4;
      $smallFill = ($smallCols - ($renderedCount % $smallCols)) % $smallCols;
      $largeFill = ($largeCols - ($renderedCount % $largeCols)) % $largeCols;
      $fillCount = max($smallFill, $largeFill);
      for($i = 0; $i < $fillCount; $i++):
    ?>
      <li class="about-clients__item about-clients__item--filler" aria-hidden="true"></li>
    <?php endfor ?>
  </ul>
</section>
<?php endif ?>
