<?php

declare(strict_types=1);

namespace ClueNest\Domain\Product;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductRepository
{
    public function findAll(): array
    {
        global $wpdb;

        $table = DatabaseManager::getProductsTable();

        $results = $wpdb->get_results(
            "SELECT * FROM {$table} ORDER BY id DESC",
            ARRAY_A
        );

        return $results ?: [];
    }

    public function findById(int $id): ?array
    {
        global $wpdb;

        $table = DatabaseManager::getProductsTable();

        $product = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            ),
            ARRAY_A
        );

        return $product ?: null;
    }

    public function save(array $data): int
{
    global $wpdb;

    $table = DatabaseManager::getProductsTable();

    $wpdb->insert(
        $table,
        [
            'slug' => $data['slug'],
            'name' => $data['name'],
            'status' => $data['status'],
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        ],
        [
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ]
    );

    return (int) $wpdb->insert_id;
}
}