<?php
if (!defined('ABSPATH')) exit;

/**
 * Ricorda un valore in object cache (Redis se attivo). TTL in secondi.
 * Gruppo di default: 'cdt'.
 */
function cdt_cache_remember( string $key, int $ttl, callable $callback, string $group = 'cdt' ) {
  $cache_key = md5($key);
  $data = wp_cache_get($cache_key, $group);
  if (false !== $data) return $data;

  $data = call_user_func($callback);
  // Non cache-iamo false per evitare confusioni in get
  if ($data !== null) {
    wp_cache_set($cache_key, $data, $group, $ttl);
  }
  return $data;
}
