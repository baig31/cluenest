<?php

declare(strict_types=1);

namespace ClueNest\Database;

defined('ABSPATH') || exit;

final class Migrator
{
    public function migrate(): void
    {
        $installedVersion = get_option(DatabaseVersion::OPTION_NAME);

        if ($installedVersion === DatabaseVersion::VERSION) {
            return;
        }

        /**
         * Table creation will be added here.
         */

        update_option(
            DatabaseVersion::OPTION_NAME,
            DatabaseVersion::VERSION
        );
    }
}