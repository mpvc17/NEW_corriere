<?php get_header(); ?>
<header class="wrap archive__header"><h1><?php the_archive_title(); ?></h1></header>
<section class="wrap loop cdt-grid">
<?php if (have_posts()): while (have_posts()): the_post(); cdt_post_card(get_post()); endwhile; endif; ?>
</section>
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>
