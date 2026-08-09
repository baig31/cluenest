<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductSeoTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getProductSeoTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            product_id BIGINT UNSIGNED NOT NULL,
            seo_title VARCHAR(255) DEFAULT NULL,
            meta_description TEXT NULL,
            focus_keyword VARCHAR(255) DEFAULT NULL,
            canonical_url TEXT NULL,
            robots_index VARCHAR(20) NOT NULL DEFAULT 'index',
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY product_id (product_id)
        ) {$charsetCollate};";
    }
}