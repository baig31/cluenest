<?php

declare(strict_types=1);

namespace ClueNest\Core;

use ClueNest\Database\Migrator;

defined('ABSPATH') || exit;

final class Activator
{
    public static function activate(): void
    {
        $migrator = new Migrator();
        $migrator->migrate();
    }
}