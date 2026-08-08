<?php

declare(strict_types=1);

namespace ClueNest\Database\ProductProsCons;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductProsConsRepository
{
    /**
     * Save product pros and cons.
     */
    public function save(int $productId, array $items): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductProsConsTable();

        foreach ($items as $index => $item) {

            $result = $wpdb->insert(
                $table,
                [
                    'product_id' => $productId,
                    'type'       => $item['type'],
                    'content'    => $item['content'],
                    'sort_order' => $index,
                    'created_at' => current_time('mysql'),
                    'updated_at' => current_time('mysql'),
                ],
                [
                    '%d',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%s',
                ]
            );

            if ($result === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get all pros and cons for a product.
     */
    public function getByProductId(int $productId): array
    {
        global $wpdb;

        $table = DatabaseManager::getProductProsConsTable();

        $results = $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE product_id = %d
                ORDER BY sort_order ASC, id ASC
                ",
                $productId
            )
        );

        return $results ?: [];
    }

    /**
     * Delete all pros and cons for a product.
     */
    public function deleteByProductId(int $productId): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductProsConsTable();

        $result = $wpdb->delete(
            $table,
            [
                'product_id' => $productId,
            ],
            [
                '%d',
            ]
        );

        return $result !== false;
    }
}