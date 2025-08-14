<?php
if (!defined('ABSPATH')) exit;
get_header(); ?>

<div class="wrap">
  <?php
  $paged = max(1, (int) get_query_var('paged'));
  $key = 'home_pg_' . $paged;

  $posts = cdt_remember($key, 90, function () use ($paged) {
    $q = new WP_Query([
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'posts_per_page' => 12,
      'paged'          => $paged,
      'ignore_sticky_posts' => true,
      'no_found_rows'  => true,
      'orderby'        => 'date',
      'order'          => 'DESC',
    ]);
    return $q->posts;
  });

  echo '<div class="cdt-grid">';
  foreach ($posts as $p) {
    $post = $p; // setup var for template
    include locate_template('template-parts/card.php', false, false);
  }
  echo '</div>';

  // Pagina successiva (link semplice, nessun count)
  if (count($posts) === 12) {
    $next = get_pagenum_link($paged + 1);
    echo '<p style="text-align:center;margin:24px 0;"><a class="button" href="'.esc_url($next).'">Carica altri</a></p>';
  }
  ?>
</div>

<?php get_footer();
