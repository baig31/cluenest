<?php

declare(strict_types=1);

namespace ClueNest\Database\BuyingGuide;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BuyingGuideRepository
{
    private string $table;

    public function __construct()
    {
        $this->table = DatabaseManager::getBuyingGuidesTable();
    }

    /**
     * Get all buying guides.
     */
    public function getAll(): array
    {
        global $wpdb;

        return $wpdb->get_results(
            "SELECT *
             FROM {$this->table}
             WHERE deleted_at IS NULL
             ORDER BY id DESC"
        );
    }

    /**
     * Get a buying guide by ID.
     */
    public function getById(int $id): ?object
    {
        global $wpdb;

        return $wpdb->get_row(
            $wpdb->prepare(
                "SELECT *
                 FROM {$this->table}
                 WHERE id = %d
                 AND deleted_at IS NULL
                 LIMIT 1",
                $id
            )
        );
    }

    /**
     * Create a buying guide.
     */
    public function create(array $data): int
    {
        global $wpdb;

        $now = current_time('mysql');

        $inserted = $wpdb->insert(
            $this->table,
            [
                'category_id'        => $data['category_id'] ?? null,
                'featured_image_id'  => $data['featured_image_id'] ?? null,
                'slug'               => $data['slug'] ?? '',
                'title'              => $data['title'] ?? '',
                'short_description'  => $data['short_description'] ?? '',
                'content'            => $data['content'] ?? '',
                'status'             => $data['status'] ?? 'draft',
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );

        if (false === $inserted) {
            throw new \RuntimeException(
                $wpdb->last_error ?: 'Unable to create buying guide.'
            );
        }

        return (int) $wpdb->insert_id;
    }

    /**
     * Update a buying guide.
     */
    public function update(int $id, array $data): bool
    {
        global $wpdb;

        $updated = $wpdb->update(
            $this->table,
            [
                'category_id'        => $data['category_id'] ?? null,
                'featured_image_id'  => $data['featured_image_id'] ?? null,
                'slug'               => $data['slug'] ?? '',
                'title'              => $data['title'] ?? '',
                'short_description'  => $data['short_description'] ?? '',
                'content'            => $data['content'] ?? '',
                'status'             => $data['status'] ?? 'draft',
                'updated_at'         => current_time('mysql'),
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
                '%s',
                '%s',
            ],
            [
                '%d',
            ]
        );

        if (false === $updated) {
            throw new \RuntimeException(
                $wpdb->last_error ?: 'Unable to update buying guide.'
            );
        }

        return true;
    }

    /**
     * Soft delete a buying guide.
     */
    public function delete(int $id): bool
    {
        global $wpdb;

        $deleted = $wpdb->update(
            $this->table,
            [
                'deleted_at' => current_time('mysql'),
                'updated_at' => current_time('mysql'),
            ],
            [
                'id' => $id,
            ],
            [
                '%s',
                '%s',
            ],
            [
                '%d',
            ]
        );

        if (false === $deleted) {
            throw new \RuntimeException(
                $wpdb->last_error ?: 'Unable to delete buying guide.'
            );
        }

        return true;
    }
}