<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BuyingGuideProductsTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getBuyingGuideProductsTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            buying_guide_id BIGINT UNSIGNED NOT NULL,
            product_id BIGINT UNSIGNED NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,

            PRIMARY KEY (id),
            UNIQUE KEY guide_product (buying_guide_id, product_id),
            KEY buying_guide_id (buying_guide_id),
            KEY product_id (product_id),
            KEY sort_order (sort_order)

        ) {$charsetCollate};";
    }
}