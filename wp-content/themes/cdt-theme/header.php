<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header" role="banner">
  <div class="wrap">
    <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'menu']); ?>
  </div>
</header>
<main id="content" class="site-content" role="main">
