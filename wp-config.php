<?php
// Carica .env
$env = [];
$envPath = __DIR__.'/.env';
if (file_exists($envPath)) {
  foreach (file($envPath) as $line) {
    if (!trim($line) || preg_match('/^\s*#/', $line)) continue;
    [$k,$v] = array_map('trim', explode('=', $line, 2));
    $env[$k] = trim($v, "\"'");
  }
}

define('DB_NAME',     $env['DB_NAME']     ?? 'wordpress');
define('DB_USER',     $env['DB_USER']     ?? 'root');
define('DB_PASSWORD', $env['DB_PASSWORD'] ?? '');
define('DB_HOST',     $env['DB_HOST']     ?? 'localhost');
$table_prefix = $env['TABLE_PREFIX'] ?? 'wp_';

define('WP_HOME',    $env['WP_HOME']    ?? 'http://localhost:8080');
define('WP_SITEURL', $env['WP_SITEURL'] ?? 'http://localhost:8080');

define('WP_ENVIRONMENT_TYPE', $env['WP_ENVIRONMENT_TYPE'] ?? 'production');
define('WP_DEBUG', WP_ENVIRONMENT_TYPE !== 'production');
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

define('DISALLOW_FILE_EDIT', true);
define('AUTOSAVE_INTERVAL', 120);
define('EMPTY_TRASH_DAYS', 7);

// Redis
define('WP_REDIS_HOST', $env['REDIS_HOST'] ?? '127.0.0.1');
define('WP_REDIS_PORT', intval($env['REDIS_PORT'] ?? 6379));

define('AUTH_KEY',         'change-me');
define('SECURE_AUTH_KEY',  'change-me');
define('LOGGED_IN_KEY',    'change-me');
define('NONCE_KEY',        'change-me');
define('AUTH_SALT',        'change-me');
define('SECURE_AUTH_SALT', 'change-me');
define('LOGGED_IN_SALT',   'change-me');
define('NONCE_SALT',       'change-me');

if (!defined('ABSPATH')) define('ABSPATH', __DIR__ . '/');
require_once ABSPATH . 'wp-settings.php';
