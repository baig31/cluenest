<?php

declare(strict_types=1);

namespace ClueNest\Database\ProductSeo;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class ProductSeoRepository
{
    private string $table;

    public function __construct()
    {
        $this->table = DatabaseManager::getProductSeoTable();
    }

    /**
     * Get SEO data for a product.
     */
    public function getByProductId(int $productId): ?object
    {
        global $wpdb;

        return $wpdb->get_row(
            $wpdb->prepare(
                "SELECT *
                 FROM {$this->table}
                 WHERE product_id = %d
                 LIMIT 1",
                $productId
            )
        );
    }

    /**
     * Create or update SEO data for a product.
     */
    public function save(int $productId, array $data): bool
    {
        global $wpdb;

        $existing = $this->getByProductId($productId);

        $now = current_time('mysql');

        $values = [
            'product_id'       => $productId,
            'seo_title'        => $data['seo_title'] ?? '',
            'meta_description' => $data['meta_description'] ?? '',
            'focus_keyword'    => $data['focus_keyword'] ?? '',
            'canonical_url'    => $data['canonical_url'] ?? '',
            'robots_index'     => $data['robots_index'] ?? 'index',
            'updated_at'       => $now,
        ];

        if ($existing) {

            return false !== $wpdb->update(
                $this->table,
                $values,
                [
                    'product_id' => $productId,
                ],
                [
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
        }

        $values['created_at'] = $now;

        return false !== $wpdb->insert(
            $this->table,
            $values,
            [
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
    }

    /**
     * Delete SEO data for a product.
     */
    public function deleteByProductId(int $productId): bool
    {
        global $wpdb;

        return false !== $wpdb->delete(
            $this->table,
            [
                'product_id' => $productId,
            ],
            [
                '%d',
            ]
        );
    }
}