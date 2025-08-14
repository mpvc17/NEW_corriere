<?php
if (!defined('ABSPATH')) exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="cdt-header" class="cdt-header">
  <!-- 1) TOP BAR -->
  <div class="cdt-topbar">
    <div class="wrap cdt-topbar__inner">
      <div class="cdt-topbar__left">
        <span id="cdt-datetime" aria-live="polite">—</span>
        <span class="cdt-sep">•</span>
        <span id="cdt-weather" aria-live="polite">Meteo Taranto: …</span>
      </div>
      <div class="cdt-topbar__right" aria-label="Tema">
        <button class="cdt-theme-btn" data-theme="light" title="Tema chiaro">☀️</button>
        <button class="cdt-theme-btn" data-theme="system" title="Tema di sistema">💻</button>
        <button class="cdt-theme-btn" data-theme="dark" title="Tema scuro">🌙</button>
      </div>
    </div>
  </div>

  <!-- 2) LOGO BAR -->
  <div class="cdt-logobar">
    <div class="wrap cdt-logobar__inner">
      <div class="cdt-logo">
        <?php
          if (function_exists('the_custom_logo') && has_custom_logo()) the_custom_logo();
          else echo '<a class="site-title" href="'.esc_url(home_url('/')).'">'.esc_html(get_bloginfo('name')).'</a>';
        ?>
      </div>
    </div>
  </div>

  <!-- 3) NAV BAR -->
  <nav class="cdt-navbar" role="navigation" aria-label="<?php esc_attr_e('Primary', 'cdt-news'); ?>">
    <div class="wrap">
      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'cdt-menu',
        'fallback_cb'    => false,
      ]);
      ?>
    </div>
  </nav>

  <!-- 4) TICKER BAR -->
  <div class="cdt-tickerbar" role="region" aria-label="Ultime dalla sezione Striscia">
    <div class="wrap">
      <?php
      $items = function_exists('cdt_get_ticker_items') ? cdt_get_ticker_items(20, 90) : [];
      if (!empty($items)) : ?>
      <div class="cdt-ticker" aria-live="off">
        <div class="cdt-ticker__track">
          <?php foreach ($items as $it): ?>
            <a class="cdt-ticker__item" href="<?php echo esc_url($it['url']); ?>">
              <?php echo esc_html($it['title']); ?>
            </a>
          <?php endforeach; ?>
          <?php // duplichiamo per loop continuo ?>
          <?php foreach ($items as $it): ?>
            <a class="cdt-ticker__item" href="<?php echo esc_url($it['url']); ?>">
              <?php echo esc_html($it['title']); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php else: ?>
        <div class="cdt-ticker__placeholder">Nessun elemento nella categoria “striscia”.</div>
      <?php endif; ?>
    </div>
  </div>
</header>

<main id="content" class="site-content">
