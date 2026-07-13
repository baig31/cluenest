<?php

declare(strict_types=1);

namespace ClueNest\Core;

use ClueNest\Admin\AdminMenu;

defined('ABSPATH') || exit;

final class Engine
{
    public function boot(): void
    {
        if (! is_admin()) {
            return;
        }

        $adminMenu = new AdminMenu();
        $adminMenu->register();
    }
}