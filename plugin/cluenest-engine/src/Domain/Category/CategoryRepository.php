<?php

declare(strict_types=1);

namespace ClueNest\Domain\Category;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class CategoryRepository
{
    public function findAll(): array
    {
        global $wpdb;

        $table = DatabaseManager::getCategoriesTable();

        $results = $wpdb->get_results(
            "SELECT * FROM {$table} ORDER BY name ASC",
            ARRAY_A
        );

        return $results ?: [];
    }

    public function findById(int $id): ?array
    {
        global $wpdb;

        $table = DatabaseManager::getCategoriesTable();

        $category = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            ),
            ARRAY_A
        );

        return $category ?: null;
    }

    public function save(array $data): int
    {
        global $wpdb;

        $table = DatabaseManager::getCategoriesTable();

        $wpdb->insert(
            $table,
            [
                'parent_id'   => $data['parent_id'],
                'name'        => $data['name'],
                'slug'        => $data['slug'],
                'description' => $data['description'],
                'status'      => $data['status'],
                'created_at'  => current_time('mysql'),
                'updated_at'  => current_time('mysql'),
            ]
        );

        return (int) $wpdb->insert_id;
    }

    public function update(int $id, array $data): bool
    {
        global $wpdb;

        $table = DatabaseManager::getCategoriesTable();

        $result = $wpdb->update(
            $table,
            [
                'parent_id'   => $data['parent_id'],
                'name'        => $data['name'],
                'slug'        => $data['slug'],
                'description' => $data['description'],
                'status'      => $data['status'],
                'updated_at'  => current_time('mysql'),
            ],
            [
                'id' => $id,
            ]
        );

        return $result !== false;
    }

    public function delete(int $id): bool
    {
        global $wpdb;

        $table = DatabaseManager::getCategoriesTable();

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