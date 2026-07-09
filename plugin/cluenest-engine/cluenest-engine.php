<?php
/**
 * Plugin Name: ClueNest Engine
 * Plugin URI: https://cluenest.com
 * Description: Core engine for the ClueNest Product Intelligence Platform.
 * Version: 1.0.0
 * Requires at least: 6.8
 * Requires PHP: 8.2
 * Author: Adil Baig
 * Author URI: https://cluenest.com
 * License: GPL-2.0-or-later
 * Text Domain: cluenest-engine
 */

defined('ABSPATH') || exit;

define('CN_VERSION', '1.0.0');
define('CN_PLUGIN_FILE', __FILE__);
define('CN_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CN_PLUGIN_URL', plugin_dir_url(__FILE__));

register_activation_hook(__FILE__, 'cn_activate');
register_deactivation_hook(__FILE__, 'cn_deactivate');

function cn_activate() {
    flush_rewrite_rules();
}

function cn_deactivate() {
    flush_rewrite_rules();
}

function cn_boot() {
    // Core framework will load here.
}

cn_boot();