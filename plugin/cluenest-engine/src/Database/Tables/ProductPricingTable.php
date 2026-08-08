<?php

declare(strict_types=1);

namespace ClueNest\Database\Tables;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductPricingTable
{
    public function getTableName(): string
    {
        return DatabaseManager::getProductPricingTable();
    }

    public function getSchema(): string
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        return "CREATE TABLE {$this->getTableName()} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            product_id BIGINT UNSIGNED NOT NULL,
            price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            original_price DECIMAL(12,2) DEFAULT NULL,
            affiliate_url TEXT NULL,
            affiliate_network VARCHAR(50) DEFAULT NULL,
            currency VARCHAR(10) NOT NULL DEFAULT 'INR',
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,

            PRIMARY KEY (id),
            KEY product_id (product_id),
            KEY affiliate_network (affiliate_network)

        ) {$charsetCollate};";
    }
}