<?php

declare(strict_types=1);

namespace ClueNest\Database\ProductPricing;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductPricingRepository
{
    /**
     * Save product pricing.
     */
    public function save(int $productId, array $data): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductPricingTable();

        return false !== $wpdb->insert(
            $table,
            [
                'product_id'       => $productId,
                'price'            => $data['price'],
                'original_price'   => $data['original_price'],
                'affiliate_url'    => $data['affiliate_url'],
                'affiliate_network'=> $data['affiliate_network'],
                'currency'         => $data['currency'],
                'created_at'       => current_time('mysql'),
                'updated_at'       => current_time('mysql'),
            ],
            [
                '%d',
                '%f',
                '%f',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );
    }

    /**
     * Get pricing for a product.
     */
    public function getByProductId(int $productId): ?object
    {
        global $wpdb;

        $table = DatabaseManager::getProductPricingTable();

        return $wpdb->get_row(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE product_id = %d
                LIMIT 1
                ",
                $productId
            )
        );
    }

    /**
     * Delete pricing for a product.
     */
    public function deleteByProductId(int $productId): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductPricingTable();

        return false !== $wpdb->delete(
            $table,
            [
                'product_id' => $productId,
            ],
            [
                '%d',
            ]
        );
    }
}