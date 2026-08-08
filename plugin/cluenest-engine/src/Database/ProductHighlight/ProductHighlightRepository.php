<?php

declare(strict_types=1);

namespace ClueNest\Database\ProductHighlight;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductHighlightRepository
{
    /**
     * Save product highlights.
     */
    public function save(int $productId, array $highlights): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductHighlightsTable();

        foreach ($highlights as $index => $highlight) {

            $result = $wpdb->insert(
                $table,
                [
                    'product_id' => $productId,
                    'highlight'  => $highlight,
                    'sort_order' => $index,
                    'created_at' => current_time('mysql'),
                    'updated_at' => current_time('mysql'),
                ],
                [
                    '%d',
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
     * Get highlights by product.
     */
    public function getByProductId(int $productId): array
    {
        global $wpdb;

        $table = DatabaseManager::getProductHighlightsTable();

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
     * Delete all highlights for a product.
     */
    public function deleteByProductId(int $productId): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductHighlightsTable();

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