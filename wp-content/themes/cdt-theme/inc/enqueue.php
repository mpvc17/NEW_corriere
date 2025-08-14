<?php
if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function () {
  $style_path = get_stylesheet_directory() . '/style.css';
  $ver = file_exists($style_path) ? filemtime($style_path) : null;

  wp_enqueue_style('cdt-style', get_stylesheet_uri(), [], $ver);

  // Stile blocco posts-grid (registrato solo se il file esiste)
  $pg_rel   = '/blocks/posts-grid/style.css';
  $pg_file  = get_template_directory() . $pg_rel;
  $pg_uri   = get_template_directory_uri() . $pg_rel;

  if (file_exists($pg_file)) {
    wp_register_style('cdt-posts-grid', $pg_uri, [], filemtime($pg_file));
  }
});
