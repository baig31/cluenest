<?php

declare(strict_types=1);

namespace ClueNest\Core;

use ClueNest\Admin\AdminMenu;

final class Engine
{
    public function boot(): void
    {
        if (is_admin()) {
            new AdminMenu();
        }
    }
}