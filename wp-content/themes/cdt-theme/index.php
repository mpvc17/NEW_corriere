<?php get_header(); ?>
<section class="wrap loop">
<?php if (have_posts()): while (have_posts()): the_post(); ?>
  <?php cdt_post_card(get_post()); ?>
<?php endwhile; endif; ?>
</section>
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>
