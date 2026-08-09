<?php

declare(strict_types=1);

namespace ClueNest\Database\BuyingGuide;

use ClueNest\Database\DatabaseManager;

defined('ABSPATH') || exit;

final class BuyingGuideProductRepository
{
    private string $table;

    public function __construct()
    {
        $this->table = DatabaseManager::getBuyingGuideProductsTable();
    }

    /**
     * Get products assigned to a buying guide.
     */
    public function getByBuyingGuideId(int $buyingGuideId): array
    {
        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                 FROM {$this->table}
                 WHERE buying_guide_id = %d
                 ORDER BY sort_order ASC, id ASC",
                $buyingGuideId
            )
        );
    }

    /**
     * Save product relationships for a buying guide.
     */
    public function save(
        int $buyingGuideId,
        array $productIds
    ): bool {
        global $wpdb;

        $wpdb->delete(
            $this->table,
            [
                'buying_guide_id' => $buyingGuideId,
            ],
            [
                '%d',
            ]
        );

        $now = current_time('mysql');

        foreach ($productIds as $sortOrder => $productId) {

            $productId = (int) $productId;

            if ($productId <= 0) {
                continue;
            }

            $inserted = $wpdb->insert(
                $this->table,
                [
                    'buying_guide_id' => $buyingGuideId,
                    'product_id'      => $productId,
                    'sort_order'      => $sortOrder,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ],
                [
                    '%d',
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                ]
            );

            if (false === $inserted) {
                throw new \RuntimeException(
                    $wpdb->last_error ?: 'Unable to save buying guide products.'
                );
            }
        }

        return true;
    }
}