<?php
if (!defined('ABSPATH')) exit;
get_header();
the_post(); ?>
<article <?php post_class('wrap article'); ?>>
  <header class="article__header">
    <h1><?php the_title(); ?></h1>
    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo get_the_date(); ?></time>
  </header>
  <?php if (has_post_thumbnail()) the_post_thumbnail('cdt-hero', ['loading'=>'eager','fetchpriority'=>'high']); ?>
  <div class="article__content">
    <?php the_content(); ?>
  </div>
</article>
<?php get_footer();
