<?php

declare(strict_types=1);

namespace ClueNest\Domain\ProductSeo;

use ClueNest\Database\ProductSeo\ProductSeoRepository;

defined('ABSPATH') || exit;

final class ProductSeoService
{
    public function __construct(
        private readonly ProductSeoRepository $repository = new ProductSeoRepository()
    ) {
    }

    /**
     * Get SEO data for a product.
     */
    public function getByProductId(int $productId): ?object
    {
        return $this->repository->getByProductId($productId);
    }

    /**
     * Save SEO data for a product.
     */
    public function save(int $productId, array $data): bool
    {
        $data = $this->validate($data);

        return $this->repository->save(
            $productId,
            $data
        );
    }

    /**
     * Validate and sanitize SEO data.
     */
    private function validate(array $data): array
    {
        $robotsIndex = sanitize_text_field(
            $data['robots_index'] ?? 'index'
        );

        if (!in_array($robotsIndex, ['index', 'noindex'], true)) {
            $robotsIndex = 'index';
        }

        return [
            'seo_title' => sanitize_text_field(
                $data['seo_title'] ?? ''
            ),

            'meta_description' => sanitize_textarea_field(
                $data['meta_description'] ?? ''
            ),

            'focus_keyword' => sanitize_text_field(
                $data['focus_keyword'] ?? ''
            ),

            'canonical_url' => esc_url_raw(
                $data['canonical_url'] ?? ''
            ),

            'robots_index' => $robotsIndex,
        ];
    }
}