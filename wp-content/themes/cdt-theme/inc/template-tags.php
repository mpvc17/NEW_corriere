<?php
if (!defined('ABSPATH')) exit;

function cdt_post_card($post) {
  $pid = is_object($post) ? $post->ID : $post;
  $title = get_the_title($pid);
  $permalink = get_permalink($pid);
  $thumb = get_the_post_thumbnail($pid, 'cdt-card', ['loading'=>'lazy','decoding'=>'async']);
  $date = get_the_date('d.m.Y', $pid);
  ?>
  <article class="cdt-card">
    <a href="<?php echo esc_url($permalink); ?>" class="cdt-card__thumb"><?php echo $thumb; ?></a>
    <h3 class="cdt-card__title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h3>
    <div class="cdt-card__meta"><?php echo esc_html($date); ?></div>
  </article>
  <?php
}
