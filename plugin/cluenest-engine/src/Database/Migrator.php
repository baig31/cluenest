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

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $schema = new Schema();

        foreach ($schema->getTables() as $table) {
            dbDelta($table->getSchema());
        }

        update_option(
            DatabaseVersion::OPTION_NAME,
            DatabaseVersion::VERSION
        );
    }
}