<?php

declare(strict_types=1);

namespace ClueNest\Domain\ProductPricing;

use ClueNest\Database\ProductPricing\ProductPricingRepository;

defined('ABSPATH') || exit;

final class ProductPricingService
{
    public function __construct(
        private readonly ProductPricingRepository $repository = new ProductPricingRepository()
    ) {
    }

    /**
     * Save product pricing.
     */
    public function save(int $productId, array $data): bool
    {
        $data = $this->validate($data);

        $this->repository->deleteByProductId($productId);

        return $this->repository->save(
            $productId,
            $data
        );
    }

    /**
     * Get pricing for a product.
     */
    public function getByProductId(int $productId): ?object
    {
        return $this->repository->getByProductId($productId);
    }

    /**
     * Validate pricing data.
     */
    private function validate(array $data): array
    {
        $price = isset($data['price'])
            ? (float) $data['price']
            : 0.00;

        $originalPrice = isset($data['original_price'])
            && $data['original_price'] !== ''
            ? (float) $data['original_price']
            : null;

        $affiliateUrl = esc_url_raw(
            $data['affiliate_url'] ?? ''
        );

        $affiliateNetwork = sanitize_text_field(
            $data['affiliate_network'] ?? ''
        );

        $currency = sanitize_text_field(
            $data['currency'] ?? 'INR'
        );

        if ($price < 0) {
            $price = 0.00;
        }

        if ($originalPrice !== null && $originalPrice < 0) {
            $originalPrice = null;
        }

        return [
            'price'             => $price,
            'original_price'    => $originalPrice,
            'affiliate_url'     => $affiliateUrl,
            'affiliate_network' => $affiliateNetwork,
            'currency'          => $currency ?: 'INR',
        ];
    }
}