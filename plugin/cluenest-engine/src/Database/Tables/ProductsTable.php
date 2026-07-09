<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductsTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getProductsTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            slug VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            brand_id BIGINT UNSIGNED DEFAULT NULL,
            category_id BIGINT UNSIGNED DEFAULT NULL,
            model_number VARCHAR(150) DEFAULT NULL,
            short_description TEXT NULL,
            long_description LONGTEXT NULL,
            editorial_rating DECIMAL(2,1) DEFAULT 0,
            status VARCHAR(20) NOT NULL DEFAULT 'draft',
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            deleted_at DATETIME NULL,
            PRIMARY KEY (id),
            UNIQUE KEY slug (slug),
            KEY brand_id (brand_id),
            KEY category_id (category_id),
            KEY status (status)
        ) {$charsetCollate};";
    }
}