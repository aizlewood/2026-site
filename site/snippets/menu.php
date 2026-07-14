<?php $uri = $page->uri(); ?>
<ul class="menu cf">
    <li>
        <a class="nav-link <?php e(strpos($uri, 'did') === 0, 'active') ?>" href="<?= url('did') ?>">Work</a>
    </li>
    <li>
        <a class="nav-link <?php e(strpos($uri, 'does') === 0, 'active') ?>" href="<?= url('does') ?>">Leadership</a>
    </li>
    <li>
        <a class="nav-link <?php e(strpos($uri, 'writes') === 0, 'active') ?>" href="<?= url('writes') ?>">Writing</a>
    </li>
    <li>
        <a class="nav-link <?php e(strpos($uri, 'is') === 0, 'active') ?>" href="<?= url('is') ?>">About</a>
    </li>
    <li>
        <a class="nav-link <?php e(strpos($uri, 'contacts') === 0, 'active') ?>" href="<?= url('contacts') ?>">Contact</a>
    </li>
</ul>
