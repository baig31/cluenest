<?php

declare(strict_types=1);

namespace ClueNest\Domain\Brand;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BrandRepository
{
    public function findAll(): array
    {
        global $wpdb;

        $table = DatabaseManager::getBrandsTable();

        $results = $wpdb->get_results(
            "SELECT * FROM {$table} ORDER BY name ASC",
            ARRAY_A
        );

        return $results ?: [];
    }

    public function findById(int $id): ?array
    {
        global $wpdb;

        $table = DatabaseManager::getBrandsTable();

        $brand = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            ),
            ARRAY_A
        );

        return $brand ?: null;
    }

    public function save(array $data): int
    {
        global $wpdb;

        $table = DatabaseManager::getBrandsTable();

        $wpdb->insert(
            $table,
            [
                'name'        => $data['name'],
                'slug'        => $data['slug'],
                'description' => $data['description'],
                'website'     => $data['website'],
                'logo'        => $data['logo'],
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

        $table = DatabaseManager::getBrandsTable();

        $result = $wpdb->update(
            $table,
            [
                'name'        => $data['name'],
                'slug'        => $data['slug'],
                'description' => $data['description'],
                'website'     => $data['website'],
                'logo'        => $data['logo'],
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

        $table = DatabaseManager::getBrandsTable();

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