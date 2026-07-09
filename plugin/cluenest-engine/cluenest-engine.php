<?php
/**
 * Plugin Name: ClueNest Engine
 * Description: Core Engine for ClueNest
 * Version: 1.0.0
 * Requires PHP: 8.2
 */

defined('ABSPATH') || exit;

define('CN_VERSION', '1.0.0');
define('CN_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CN_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once __DIR__ . '/src/Core/Engine.php';

$engine = new \ClueNest\Core\Engine();
$engine->boot();