<?php
if (!defined('ABSPATH')) exit;

// Enqueue stile del blocco (registrato in enqueue.php)
wp_enqueue_style('cdt-posts-grid');

$count  = (int) get_field('count');
$cat_id = get_field('cat'); // può essere null
$offset = (int) get_field('offset');
$ttl    = (int) get_field('ttl');

if ($count <= 0)  $count  = 8;
if ($offset < 0)  $offset = 0;
if ($ttl   < 30)  $ttl    = 90;

// Paginazione corrente per variare la chiave se usato in archivi
$paged = max(1, (int) get_query_var('paged'));
if ($paged === 1) {
  $page_on_front = get_option('page_on_front');
  if ($page_on_front && is_front_page()) {
    $paged = max(1, (int) get_query_var('page'));
  }
}

$key = 'pg:' . md5(json_encode(['count'=>$count, 'cat'=>$cat_id, 'offset'=>$offset, 'paged'=>$paged]));

$items = cdt_cache_remember($key, $ttl, function () use ($count, $cat_id, $offset) {
  $args = [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $count,
    'offset'              => $offset,
    'ignore_sticky_posts' => true,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'no_found_rows'       => true, // niente count(*) per performance
  ];
  if ($cat_id) $args['cat'] = (int) $cat_id;

  return get_posts($args);
});

echo '<div class="cdt-grid">';
foreach ($items as $p) {
  cdt_post_card($p);
}
echo '</div>';
