<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductSpecificationsTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getProductSpecificationsTable();
    }

    public function getSchema(): string
{
    global $wpdb;

    $charsetCollate = $wpdb->get_charset_collate();

    return "CREATE TABLE {$this->getTableName()} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        product_id BIGINT UNSIGNED NOT NULL,
        specification VARCHAR(255) NOT NULL,
        value TEXT NULL,
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NOT NULL,
        deleted_at DATETIME NULL,
        PRIMARY KEY  (id),
        KEY product_id (product_id),
        KEY sort_order (sort_order)
    ) {$charsetCollate};";
}
}