<?php

declare(strict_types=1);

namespace ClueNest\Core;

use ClueNest\Admin\AdminMenu;

defined('ABSPATH') || exit;

final class Engine
{
    public function boot(): void
    {
        require_once CN_PLUGIN_PATH . 'src/Admin/AdminMenu.php';

        $adminMenu = new AdminMenu();
        $adminMenu->register();
    }
}