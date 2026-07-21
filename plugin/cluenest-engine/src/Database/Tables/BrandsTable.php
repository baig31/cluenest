<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BrandsTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getBrandsTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            slug VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT NULL,
            website VARCHAR(255) NULL,
            logo VARCHAR(255) NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'draft',
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            deleted_at DATETIME NULL,
            PRIMARY KEY (id),
            UNIQUE KEY slug (slug),
            KEY status (status)
        ) {$charsetCollate};";
    }
}