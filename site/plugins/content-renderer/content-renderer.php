<?php

if (!function_exists('render_rich_text')) {
  function render_rich_text($fieldOrText, $page = null) {
    $raw = '';

    if (is_object($fieldOrText) && method_exists($fieldOrText, 'value')) {
      $raw = (string)$fieldOrText->value();
    } else {
      $raw = (string)$fieldOrText;
    }

    $rendered = kirbytext($raw);

    // If legacy markdown/kirbytag tokens leak through, normalize and retry.
    if (strpos($rendered, '#####') === false && strpos($rendered, '(image:') === false && strpos($rendered, '```') === false) {
      return function_exists('rewrite_root_relative_urls') ? rewrite_root_relative_urls($rendered) : $rendered;
    }

    $normalized = preg_replace("/\r\n?/", "\n", $raw);
    $normalized = preg_replace('/\(\s*image:\s*/i', '(image: ', $normalized);
    $normalized = preg_replace('/\s{2,}caption:/i', ' caption:', $normalized);
    $normalized = preg_replace('/^\-\-\-\s*$/m', '***', $normalized);
    $normalized = preg_replace('/^\s*```[a-zA-Z0-9_-]*\s*$/m', '```', $normalized);

    $rendered = kirbytext($normalized);
    if (strpos($rendered, '#####') === false && strpos($rendered, '(image:') === false && strpos($rendered, '```') === false) {
      return function_exists('rewrite_root_relative_urls') ? rewrite_root_relative_urls($rendered) : $rendered;
    }

    $inline = function($s) {
      $s = trim($s);
      $s = preg_replace('/\[(.+?)\]\((https?:\/\/[^\s\)]+)\s+"([^"]+)"\)/', '<a href="$2" title="$3">$1</a>', $s);
      $s = preg_replace('/\[(.+?)\]\((https?:\/\/[^\s\)]+)\)/', '<a href="$2">$1</a>', $s);
      $s = preg_replace('/~~(.+?)~~/', '<del>$1</del>', $s);
      $s = preg_replace('/__(.+?)__/', '<strong>$1</strong>', $s);
      $s = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $s);
      $s = preg_replace('/(?<!\w)_(?!_)(.+?)(?<!_)_(?!\w)/', '<em>$1</em>', $s);
      $s = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $s);
      return $s;
    };

    $markdownImage = function($line) {
      $line = trim($line);
      if (!preg_match('/^!\[([^\]]*)\]\((https?:\/\/[^\s\)]+)(?:\s+"([^"]+)")?\)\s*$/', $line, $m)) {
        return '';
      }
      $alt = htmlspecialchars($m[1], ENT_QUOTES, 'UTF-8');
      $url = htmlspecialchars($m[2], ENT_QUOTES, 'UTF-8');
      $title = isset($m[3]) && trim($m[3]) !== '' ? ' title="' . htmlspecialchars(trim($m[3]), ENT_QUOTES, 'UTF-8') . '"' : '';
      return '<img src="' . $url . '" alt="' . $alt . '"' . $title . '>';
    };

    $isRawHtmlLine = function($line) {
      $line = trim($line);
      if ($line === '') return false;
      // Treat any line that starts with an HTML tag as raw HTML.
      return preg_match('/^<[^>]+>/', $line) === 1;
    };

    $figureHtml = function($line) use ($page, $inline) {
      $line = trim($line);
      if (!preg_match('/^\(image:\s*([^\s\)]+)\s*(.*?)\)\s*$/i', $line, $m)) return '';
      if (!$page || !method_exists($page, 'image')) return '';
      $filename = trim($m[1]);
      $attrsRaw = trim($m[2]);
      $class = '';
      $caption = '';

      if ($attrsRaw !== '') {
        preg_match_all('/([a-zA-Z0-9_-]+):\s*(.+?)(?=\s+[a-zA-Z0-9_-]+:\s*|$)/', $attrsRaw, $attrs, PREG_SET_ORDER);
        foreach ($attrs as $attr) {
          $key = strtolower(trim($attr[1]));
          $val = trim($attr[2]);
          if ($key === 'class') $class = $val;
          if ($key === 'caption') $caption = $val;
        }
      }

      $image = $page->image($filename);
      if (!$image) return '';
      $figureClass = $class !== '' ? ' class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '"' : '';
      $altText = $caption !== "" ? trim(strip_tags($inline($caption))) : ($page && method_exists($page, "title") ? (string)$page->title() : "");
      $html  = '<figure' . $figureClass . '><img src="' . $image->url() . '" alt="' . htmlspecialchars($altText, ENT_QUOTES, 'UTF-8') . '" loading="lazy" decoding="async">';
      if ($caption !== '') $html .= '<figcaption>' . $inline($caption) . '</figcaption>';
      $html .= '</figure>';
      return $html;
    };

    $lines = explode("\n", $normalized);
    $html = '';
    $inP = false;
    $inUl = false;
    $inOl = false;
    $inBlock = false;
    $inCode = false;
    $inTable = false;
    $code = '';
    $tableHeaderDone = false;

    $closeAll = function() use (&$html, &$inP, &$inUl, &$inOl, &$inBlock, &$inTable, &$tableHeaderDone) {
      if ($inP) { $html .= '</p>'; $inP = false; }
      if ($inUl) { $html .= '</ul>'; $inUl = false; }
      if ($inOl) { $html .= '</ol>'; $inOl = false; }
      if ($inBlock) { $html .= '</blockquote>'; $inBlock = false; }
      if ($inTable) { $html .= '</tbody></table>'; $inTable = false; $tableHeaderDone = false; }
    };

    foreach ($lines as $line) {
      $trim = trim($line);

      if ($trim === '```') {
        if (!$inCode) {
          $closeAll();
          $inCode = true;
          $code = '';
        } else {
          $html .= '<pre><code>' . htmlspecialchars(rtrim($code, "\n"), ENT_QUOTES, 'UTF-8') . '</code></pre>';
          $inCode = false;
          $code = '';
        }
        continue;
      }

      if ($inCode) {
        $code .= $line . "\n";
        continue;
      }

      if ($trim === '') {
        $closeAll();
        continue;
      }

      // KirbyTag wrapped in markdown link form: [(image: file.jpg ...)](https://...)
      if (preg_match('/^\[\((image:.+)\)\]\((https?:\/\/[^\s\)]+)\)\s*$/i', $trim, $linkTag)) {
        $fig = $figureHtml('(' . trim($linkTag[1]) . ')');
        if ($fig !== '') {
          $closeAll();
          $html .= '<a href="' . htmlspecialchars($linkTag[2], ENT_QUOTES, 'UTF-8') . '">' . $fig . '</a>';
          continue;
        }
      }

      if ($trim === '***' || $trim === '----') {
        $closeAll();
        $html .= '<hr>';
        continue;
      }

      $mdImage = $markdownImage($trim);
      if ($mdImage !== '') {
        $closeAll();
        $html .= $mdImage;
        continue;
      }

      if ($isRawHtmlLine($trim)) {
        $closeAll();
        $html .= $trim;
        continue;
      }

      $fig = $figureHtml($trim);
      if ($fig !== '') {
        $closeAll();
        $html .= $fig;
        continue;
      }

      if (preg_match('/^(#{1,6})\s*(.+)$/', $trim, $m)) {
        $closeAll();
        $lvl = strlen($m[1]);
        $html .= '<h' . $lvl . '>' . $inline($m[2]) . '</h' . $lvl . '>';
        continue;
      }

      // Markdown tables
      if (preg_match('/^\|.*\|$/', $trim)) {
        $cells = array_map('trim', explode('|', trim($trim, '|')));
        $isDivider = count($cells) > 0 && !array_filter($cells, function($c) {
          return preg_match('/^:?-{3,}:?$/', $c) !== 1;
        });

        if (!$inTable) {
          $closeAll();
          $inTable = true;
          $tableHeaderDone = false;
          $html .= '<table><thead>';
        }

        if ($isDivider) {
          if (!$tableHeaderDone) {
            $html .= '</tr></thead><tbody>';
            $tableHeaderDone = true;
          }
          continue;
        }

        if (!$tableHeaderDone) {
          $html .= '<tr>';
          foreach ($cells as $cell) {
            $html .= '<th>' . $inline($cell) . '</th>';
          }
        } else {
          $html .= '<tr>';
          foreach ($cells as $cell) {
            $html .= '<td>' . $inline($cell) . '</td>';
          }
          $html .= '</tr>';
        }
        continue;
      }

      if (preg_match('/^>\s*(.+)$/', $trim, $m)) {
        if (!$inBlock) { $closeAll(); $html .= '<blockquote>'; $inBlock = true; }
        $html .= '<p>' . $inline($m[1]) . '</p>';
        continue;
      }

      if (preg_match('/^\d+\.\s+(.+)$/', $trim, $m)) {
        if (!$inOl) { $closeAll(); $html .= '<ol>'; $inOl = true; }
        $html .= '<li>' . $inline($m[1]) . '</li>';
        continue;
      }

      if (preg_match('/^[\-\*]\s+(.+)$/', $trim, $m)) {
        if (!$inUl) { $closeAll(); $html .= '<ul>'; $inUl = true; }
        $html .= '<li>' . $inline($m[1]) . '</li>';
        continue;
      }

      if (!$inP) { $closeAll(); $html .= '<p>'; $inP = true; }
      else { $html .= ' '; }
      $html .= $inline($trim);
    }

    if ($inCode) {
      $html .= '<pre><code>' . htmlspecialchars(rtrim($code, "\n"), ENT_QUOTES, 'UTF-8') . '</code></pre>';
    }

    $closeAll();
    return function_exists('rewrite_root_relative_urls') ? rewrite_root_relative_urls($html) : $html;
  }
}


if (!function_exists('site_base_path')) {
  function site_base_path() {
    $path = parse_url(site()->url(), PHP_URL_PATH);
    $path = is_string($path) ? trim($path, '/') : '';
    return $path !== '' ? '/' . $path : '';
  }
}

if (!function_exists('rewrite_root_relative_urls')) {
  function rewrite_root_relative_urls($html) {
    if (!is_string($html) || $html === '') {
      return $html;
    }

    $base = site_base_path();
    if ($base === '') {
      return $html;
    }

    return preg_replace_callback('~\b(href|src)=([\'\"])/(?!/)([^\'\"]*)\2~i', function ($m) use ($base) {
      $path = ltrim($m[3], '/');
      return $m[1] . '=' . $m[2] . $base . '/' . $path . $m[2];
    }, $html);
  }
}

if (!function_exists('site_badge_registry')) {
  function site_badge_registry() {
    static $registry = null;

    if ($registry !== null) {
      return $registry;
    }

    $defaults = array(
      'post' => array('slug' => 'post', 'label' => 'Post', 'palette' => 'amber', 'tone' => 'amber', 'url' => url('writes')),
      'project' => array('slug' => 'project', 'label' => 'Project', 'palette' => 'mint', 'tone' => 'mint', 'url' => url('did')),
      'product' => array('slug' => 'product', 'label' => 'Product', 'palette' => 'pink', 'tone' => 'pink', 'url' => url('reads')),
      'bikes' => array('slug' => 'bikes', 'label' => 'Bikes', 'palette' => 'violet', 'tone' => 'violet', 'url' => url('bikes')),
      'leadership' => array('slug' => 'leadership', 'label' => 'Leadership', 'palette' => 'sky', 'tone' => 'sky', 'url' => url('does')),
      'career' => array('slug' => 'career', 'label' => 'Career', 'palette' => 'indigo', 'tone' => 'indigo', 'url' => url('is')),
      'fun' => array('slug' => 'fun', 'label' => 'Fun', 'palette' => 'yellow', 'tone' => 'yellow', 'url' => url('colophon')),
      'coaching' => array('slug' => 'coaching', 'label' => 'Coaching', 'palette' => 'rose', 'tone' => 'rose', 'url' => url('does')),
    );

    $registry = $defaults;

    $field = site()->content()->get('badges');
    if ($field && method_exists($field, 'yaml')) {
      $rows = $field->yaml();
      if (is_array($rows) && !empty($rows)) {
        $registry = array();
        foreach ($rows as $row) {
          if (!is_array($row)) {
            continue;
          }

          $slug = isset($row['slug']) ? strtolower(trim((string)$row['slug'])) : '';
          if ($slug === '') {
            continue;
          }

          $label = isset($row['label']) && trim((string)$row['label']) !== '' ? trim((string)$row['label']) : ucfirst($slug);
          $palette = isset($row['palette']) && trim((string)$row['palette']) !== '' ? trim((string)$row['palette']) : (isset($defaults[$slug]) ? $defaults[$slug]['palette'] : 'neutral');
          $url = isset($defaults[$slug]) ? $defaults[$slug]['url'] : url();

          $registry[$slug] = array(
            'slug' => $slug,
            'label' => $label,
            'palette' => $palette,
            'tone' => $palette,
            'url' => $url,
          );
        }
      }
    }

    if (empty($registry)) {
      $registry = $defaults;
    }

    return $registry;
  }
}

if (!function_exists('site_badge_options')) {
  function site_badge_options() {
    $options = array();
    foreach (site_badge_registry() as $slug => $badge) {
      $options[$slug] = isset($badge['label']) ? $badge['label'] : ucfirst($slug);
    }
    return $options;
  }
}


if (!function_exists('page_content_value')) {
  function page_content_value($page, $names = array()) {
    if (!$page || !method_exists($page, 'content')) {
      return null;
    }

    $content = $page->content();
    if (!is_object($content) || !method_exists($content, 'toArray')) {
      return null;
    }

    $data = array_change_key_case((array)$content->toArray(), CASE_LOWER);
    foreach ((array)$names as $name) {
      $key = strtolower(trim((string)$name));
      if ($key === '' || !array_key_exists($key, $data)) {
        continue;
      }

      $value = trim((string)$data[$key]);
      if ($value !== '') {
        return $value;
      }
    }

    return null;
  }
}

if (!function_exists('page_content_has_field')) {
  function page_content_has_field($page, $name) {
    if (!$page || !method_exists($page, 'content')) {
      return false;
    }

    $content = $page->content();
    if (!is_object($content) || !method_exists($content, 'toArray')) {
      return false;
    }

    $data = array_change_key_case((array)$content->toArray(), CASE_LOWER);
    return array_key_exists(strtolower(trim((string)$name)), $data);
  }
}


if (!function_exists('site_badge')) {
  function site_badge($slug = null) {
    if ($slug === null || $slug === '') {
      return null;
    }

    $registry = site_badge_registry();
    return isset($registry[$slug]) ? $registry[$slug] : null;
  }
}

if (!function_exists('page_section_context')) {
  function page_section_context($page) {
    if (!$page || !method_exists($page, 'isHomePage') || $page->isHomePage()) {
      return null;
    }

    $section = $page;
    while ($section->parent() && !$section->parent()->isSite()) {
      $section = $section->parent();
    }

    if (!$section || !method_exists($section, 'uid')) {
      return null;
    }

    $slug = $section->uid();
    $labels = array(
      'writes' => 'Writing',
      'did' => 'Work',
      'does' => 'Leadership',
      'is' => 'About',
      'bikes' => 'Bikes',
      'reads' => 'Reading',
      'contact' => 'Contact',
      'colophon' => 'Colophon',
      'what-is-it' => 'About',
      'feed' => 'Feed',
    );

    return array(
      'slug' => $slug,
      'label' => isset($labels[$slug]) ? $labels[$slug] : (string)$section->title(),
      'url' => $section->url(),
    );
  }
}

if (!function_exists('page_default_badge_slug')) {
  function page_default_badge_slug($page) {
    if (!$page) {
      return null;
    }

    $template = method_exists($page, 'intendedTemplate') ? (string)$page->intendedTemplate() : '';
    $section = page_section_context($page);
    $sectionSlug = $section ? $section['slug'] : '';

    switch ($template) {
      case 'article':
      case 'blog':
        return 'post';
      case 'project':
        return 'project';
      case 'work':
        return 'project';
      case 'bike':
        return 'bikes';
      case 'bikes':
        return 'bikes';
      case 'about':
        return 'career';
      case 'services':
        return 'leadership';
      case 'books':
        return 'product';
      case 'book':
        return 'product';
      case 'full-width':
      case 'default':
      case 'home':
        switch ($sectionSlug) {
          case 'writes':
            return 'post';
          case 'did':
            return 'project';
          case 'does':
            return 'leadership';
          case 'is':
            return 'career';
          case 'bikes':
            return 'bikes';
          case 'reads':
            return 'product';
          default:
            return 'post';
        }
      default:
        return 'post';
    }
  }
}

if (!function_exists('page_badge_slug')) {
  function page_badge_slug($page) {
    if (!$page) {
      return null;
    }

    $explicit = page_content_value($page, array('badge'));
    return $explicit !== null ? strtolower(trim($explicit)) : null;
  }
}


if (!function_exists('page_badge_context')) {
  function page_badge_context($page) {
    $slug = page_badge_slug($page);
    if (!$slug) {
      return null;
    }

    $badge = site_badge($slug);
    if (!$badge) {
      $badge = array(
        'slug' => $slug,
        'label' => ucfirst($slug),
        'palette' => 'neutral',
        'url' => page_section_context($page) ? page_section_context($page)['url'] : url(),
      );
    }

    if (empty($badge['url'])) {
      $section = page_section_context($page);
      $badge['url'] = $section ? $section['url'] : url();
    }

    return $badge;
  }
}

if (!function_exists('page_feed_timestamp')) {
  function page_feed_timestamp($page) {
    if (!$page) {
      return time();
    }

    $dateValue = page_content_value($page, array('feeddate', 'date'));
    if ($dateValue !== null) {
      $timestamp = strtotime($dateValue);
      if ($timestamp !== false) {
        return $timestamp;
      }
    }

    return method_exists($page, 'modified') ? $page->modified() : time();
  }
}

if (!function_exists('page_feed_source_field')) {
  function page_feed_source_field($page) {
    if (!$page || !method_exists($page, 'content')) {
      return null;
    }

    $candidates = array('lede', 'summary', 'intro', 'status', 'text', 'text2', 'text3');
    foreach ($candidates as $name) {
      $field = $page->content()->get($name);
      if ($field && method_exists($field, 'value') && trim($field->value()) !== '') {
        return $field;
      }
    }

    return null;
  }
}

if (!function_exists('page_feed_excerpt')) {
  function page_feed_excerpt($page, $length = 220) {
    $field = page_feed_source_field($page);
    if (!$field) {
      return '';
    }

    $raw = method_exists($field, 'value') ? (string)$field->value() : (string)$field;
    $raw = preg_replace('/^\s*\(image:[^\n]*\)\s*$/im', ' ', $raw);
    $raw = preg_replace('/\(\s*image:[^)]+\)/i', ' ', $raw);
    $raw = preg_replace('/\(\s*link:\s*\S+\s+text:\s*([^)]+?)\s*\)/i', '$1', $raw);

    $html = kirbytext($raw);
    $text = trim(preg_replace('/\s+/', ' ', strip_tags(preg_replace('/<[^>]+>/', ' ', $html))));
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = preg_replace('/\s+([.,!?;:])/', '$1', $text);
    return str::excerpt($text, $length);
  }
}

if (!function_exists('feed_sort_pages')) {
  function feed_sort_pages($pages) {
    $items = array();

    if (is_array($pages)) {
      $items = $pages;
    } else if (is_object($pages) && method_exists($pages, 'toArray')) {
      $items = $pages->toArray();
    } else {
      foreach ($pages as $page) {
        $items[] = $page;
      }
    }

    usort($items, function($a, $b) {
      $ta = page_feed_timestamp($a);
      $tb = page_feed_timestamp($b);
      if ($ta === $tb) {
        $aid = method_exists($a, 'id') ? $a->id() : '';
        $bid = method_exists($b, 'id') ? $b->id() : '';
        return strcmp($bid, $aid);
      }
      return ($tb > $ta) ? 1 : -1;
    });

    return $items;
  }
}

if (!function_exists('feed_pages')) {
  function feed_pages($exclude = array()) {
    $exclude = array_merge(array('home', 'feed', 'error', 'what-is-it'), (array)$exclude);
    $items = array();

    foreach (site()->index()->visible() as $item) {
      if (in_array($item->uid(), $exclude, true)) {
        continue;
      }

      if (!page_badge_slug($item)) {
        continue;
      }

      $items[] = $item;
    }

    return feed_sort_pages($items);
  }
}
