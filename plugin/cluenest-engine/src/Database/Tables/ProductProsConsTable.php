<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductProsConsTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getProductProsConsTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            product_id BIGINT UNSIGNED NOT NULL,
            type VARCHAR(10) NOT NULL,
            content TEXT NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            deleted_at DATETIME NULL,
            PRIMARY KEY  (id),
            KEY product_id (product_id),
            KEY type (type),
            KEY sort_order (sort_order)
        ) {$charsetCollate};";
    }
}