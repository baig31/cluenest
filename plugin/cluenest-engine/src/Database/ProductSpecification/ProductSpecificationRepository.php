<?php

declare(strict_types=1);

namespace ClueNest\Database\ProductSpecification;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductSpecificationRepository
{
    /**
     * Save product specifications.
     */
    public function save(int $productId, array $specifications): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductSpecificationsTable();

        foreach ($specifications as $row) {

            $result = $wpdb->insert(
                $table,
                [
                    'product_id'    => $productId,
                    'specification' => $row['specification'],
                    'value'         => $row['value'],
                    'created_at'    => current_time('mysql'),
                    'updated_at'    => current_time('mysql'),
                ],
                [
                    '%d',
                    '%s',
                    '%s',
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
     * Get all specifications for a product.
     */
    public function getByProductId(int $productId): array
    {
        global $wpdb;

        $table = DatabaseManager::getProductSpecificationsTable();

        $results = $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE product_id = %d
                ORDER BY id ASC
                ",
                $productId
            )
        );

        return $results ?: [];
    }

    /**
     * Delete all specifications for a product.
     */
    public function deleteByProductId(int $productId): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductSpecificationsTable();

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