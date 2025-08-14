<?php
if (!defined('ABSPATH')) exit;

// Setup base
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','script','style']);
});

// Enqueue + tag template
require_once __DIR__ . '/inc/enqueue.php';
require_once __DIR__ . '/inc/template-tags.php';
require_once __DIR__ . '/inc/cache.php';
require_once __DIR__ . '/inc/blocks.php';

// Include opzionali SOLO se esistono (evita fatal)
foreach (['cache.php','blocks.php'] as $f) {
  $p = __DIR__ . '/inc/' . $f;
  if (file_exists($p)) require_once $p;
}

add_filter('use_block_editor_for_post_type', function($use, $type){
  return true; // forza Gutenberg per ogni post type
}, 999, 2);
