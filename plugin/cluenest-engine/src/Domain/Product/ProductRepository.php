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

        $productsTable   = DatabaseManager::getProductsTable();
        $brandsTable     = DatabaseManager::getBrandsTable();
        $categoriesTable = DatabaseManager::getCategoriesTable();

        $results = $wpdb->get_results("
            SELECT
                p.*,
                b.name AS brand_name,
                c.name AS category_name
            FROM {$productsTable} p
            LEFT JOIN {$brandsTable} b
                ON p.brand_id = b.id
            LEFT JOIN {$categoriesTable} c
                ON p.category_id = c.id
            ORDER BY p.id DESC
        ");

        return $results ?: [];
    }

    public function findById(int $id): ?object
    {
        global $wpdb;

        $table = DatabaseManager::getProductsTable();

        $product = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
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
                'brand_id'    => $data['brand_id'],
                'category_id' => $data['category_id'],
                'slug'        => $data['slug'],
                'name'        => $data['name'],
                'status'      => $data['status'],
                'created_at'  => current_time('mysql'),
                'updated_at'  => current_time('mysql'),
            ],
            [
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );

        return (int) $wpdb->insert_id;
    }

    public function update(int $id, array $data): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductsTable();

        $result = $wpdb->update(
            $table,
            [
                'brand_id'    => $data['brand_id'],
                'category_id' => $data['category_id'],
                'slug'        => $data['slug'],
                'name'        => $data['name'],
                'status'      => $data['status'],
                'updated_at'  => current_time('mysql'),
            ],
            [
                'id' => $id,
            ],
            [
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
            ],
            [
                '%d',
            ]
        );

        return $result !== false;
    }

    public function delete(int $id): bool
    {
        global $wpdb;

        $table = DatabaseManager::getProductsTable();

        $result = $wpdb->delete(
            $table,
            [
                'id' => $id,
            ],
            [
                '%d',
            ]
        );

        return $result !== false;
    }
}