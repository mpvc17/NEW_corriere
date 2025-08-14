<?php
if (!defined('ABSPATH')) exit;
get_header(); ?>
<div class="wrap">
  <header class="archive__header"><h1><?php the_archive_title(); ?></h1></header>
  <div class="cdt-grid">
    <?php if (have_posts()): while (have_posts()): the_post();
      $post = get_post();
      include locate_template('template-parts/card.php', false, false);
    endwhile; endif; ?>
  </div>
  <?php the_posts_pagination(); ?>
</div>
<?php get_footer();
