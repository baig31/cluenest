<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BuyingGuidesTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getBuyingGuidesTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            category_id BIGINT UNSIGNED DEFAULT NULL,
            featured_image_id BIGINT UNSIGNED DEFAULT NULL,
            slug VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            short_description TEXT NULL,
            content LONGTEXT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'draft',
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            deleted_at DATETIME NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY slug (slug),
            KEY category_id (category_id),
            KEY featured_image_id (featured_image_id),
            KEY status (status)
        ) {$charsetCollate};";
    }
}