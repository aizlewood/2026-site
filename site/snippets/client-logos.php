<?php
$logos = array(
  array('file' => '3M.png', 'alt' => '3M logo'),
  array('file' => 'nordea.png', 'alt' => 'Nordea logo'),
  array('file' => 'prh.png', 'alt' => 'Penguin Random House logo'),
  array('file' => 'pearson.png', 'alt' => 'Pearson logo'),
  array('file' => 'nbcu.png', 'alt' => 'NBC Universal logo'),
  array('file' => 'time.png', 'alt' => 'Time logo'),
  array('file' => 'codeforamerica.png', 'alt' => 'Code for America logo'),
  array('file' => 'lmr.png', 'alt' => 'Link My Ride logo'),
  array('file' => 'bnb.png', 'alt' => 'Butternut Box logo'),
  array('file' => 'virginatlantic.png', 'alt' => 'Virgin Atlantic/Holidays logo')
);
?>
<section class="about-clients client-logo-wall" aria-label="Selected clients">
  <ul class="about-clients__grid client-logo-grid">
    <?php foreach($logos as $logo): ?>
      <li class="about-clients__item">
        <img src="<?= url('assets/images/client-logos/' . $logo['file']) ?>" alt="<?= html($logo['alt']) ?>" loading="lazy" decoding="async">
      </li>
    <?php endforeach ?>
  </ul>
</section>
