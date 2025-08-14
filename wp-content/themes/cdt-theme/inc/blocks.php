<?php
if (!defined('ABSPATH')) exit;

add_action('acf/init', function () {
  if (!function_exists('acf_register_block_type')) return;

  acf_register_block_type([
    'name'            => 'cdt-posts-grid',
    'title'           => __('CDT Posts Grid', 'cdt'),
    'description'     => __('Griglia articoli con cache', 'cdt'),
    'category'        => 'widgets',
    'icon'            => 'screenoptions',
    'mode'            => 'preview',
    'render_callback' => function ($block, $content='', $is_preview=false, $post_id=0) {
      include get_template_directory() . '/blocks/posts-grid/render.php';
    },
    'supports' => [
      'align'  => ['wide','full'],
      'anchor' => true
    ]
  ]);

  // Campi ACF per il blocco
  if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
      'key' => 'group_cdt_posts_grid',
      'title' => 'CDT Posts Grid',
      'fields' => [
        [
          'key' => 'field_cdt_pg_count',
          'label' => 'Numero articoli',
          'name' => 'count',
          'type' => 'number',
          'default_value' => 8,
          'min' => 1, 'max' => 24
        ],
        [
          'key' => 'field_cdt_pg_cat',
          'label' => 'Categoria (opzionale)',
          'name' => 'cat',
          'type' => 'taxonomy',
          'taxonomy' => 'category',
          'field_type' => 'select',
          'allow_null' => 1,
          'return_format' => 'id'
        ],
        [
          'key' => 'field_cdt_pg_offset',
          'label' => 'Offset',
          'name' => 'offset',
          'type' => 'number',
          'default_value' => 0,
          'min' => 0, 'max' => 100
        ],
        [
          'key' => 'field_cdt_pg_ttl',
          'label' => 'TTL Cache (sec)',
          'name' => 'ttl',
          'type' => 'number',
          'default_value' => 90,
          'min' => 30, 'max' => 600
        ],
      ],
      'location' => [[['param'=>'block','operator'=>'==','value'=>'acf/cdt-posts-grid']]],
      'position' => 'normal',
      'style' => 'default',
      'active' => true,
    ]);
  }
});
