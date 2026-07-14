<?php

// Copy this file to config.php locally or on the server and add private values
// such as the Kirby license key outside version control.

// c::set('license', 'YOUR-KIRBY-LICENSE-KEY');

c::set('markdown.extra', false);
c::set('content.file.extension', 'md');
c::set('markdown', true);
c::set('markdown.breaks', true);
c::set('rewrite', true);
c::set('timezone', 'GMT');
c::set('debug', false);

if (isset($_SERVER['HTTP_HOST'])) {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $basePath = isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : '';

  if (basename($basePath) === 'panel') {
    $basePath = dirname($basePath);
  }

  $basePath = $basePath === '/' || $basePath === '.' ? '' : rtrim($basePath, '/');
  c::set('url', $scheme . '://' . $_SERVER['HTTP_HOST'] . $basePath);
}
