<?php
if (!defined('ABSPATH')) exit;

/**
 * Enqueue CSS/JS header + supporti
 */
add_action('wp_enqueue_scripts', function () {
  $dir = get_stylesheet_directory();
  $uri = get_stylesheet_directory_uri();

  // CSS del child
  $ver_child = file_exists($dir.'/style.css') ? filemtime($dir.'/style.css') : null;
  wp_enqueue_style('cdt-child', get_stylesheet_uri(), [], $ver_child);

  // CSS header
  if (file_exists($dir.'/assets/css/header.css')) {
    wp_enqueue_style('cdt-header', $uri.'/assets/css/header.css', [], filemtime($dir.'/assets/css/header.css'));
  }

  // JS header (defer in footer)
  if (file_exists($dir.'/assets/js/header.js')) {
    wp_enqueue_script('cdt-header', $uri.'/assets/js/header.js', [], filemtime($dir.'/assets/js/header.js'), true);
  }
}, 20);

/**
 * Supporti: logo + immagini utili
 */
add_action('after_setup_theme', function () {
  add_theme_support('custom-logo', [
    'height'      => 120,
    'width'       => 600,
    'flex-width'  => true,
    'flex-height' => true,
  ]);
  add_image_size('cdt-card', 640, 360, true);
  add_image_size('cdt-hero', 1280, 720, true);
});

/**
 * Cache semplicissima (transient) per ticker
 */
function cdt_remember(string $key, int $ttl, callable $cb) {
  $val = get_transient($key);
  if ($val !== false) return $val;
  $val = call_user_func($cb);
  set_transient($key, $val, $ttl);
  return $val;
}

/**
 * Recupera i titoli per il ticker dalla categoria "striscia"
 */
function cdt_get_ticker_items(int $limit = 12, int $ttl = 60): array {
  return cdt_remember('cdt_ticker_'.$limit, $ttl, function () use ($limit) {
    $term = get_term_by('slug', 'striscia', 'category');
    if (!$term || is_wp_error($term)) return [];
    $ids = get_posts([
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'fields'         => 'ids',
      'posts_per_page' => $limit,
      'cat'            => (int) $term->term_id,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'no_found_rows'  => true,
      'ignore_sticky_posts' => true,
    ]);
    $items = [];
    foreach ($ids as $pid) {
      $items[] = [
        'title' => get_the_title($pid),
        'url'   => get_permalink($pid),
      ];
    }
    return $items;
  });
}
