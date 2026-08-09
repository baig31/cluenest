<?php

declare(strict_types=1);

namespace ClueNest\Domain\BuyingGuide;

use ClueNest\Database\BuyingGuide\BuyingGuideProductRepository;

defined('ABSPATH') || exit;

final class BuyingGuideProductService
{
    private BuyingGuideProductRepository $repository;

    public function __construct()
    {
        $this->repository = new BuyingGuideProductRepository();
    }

    /**
     * Get products assigned to a buying guide.
     */
    public function getByBuyingGuideId(int $buyingGuideId): array
    {
        return $this->repository->getByBuyingGuideId(
            $buyingGuideId
        );
    }

    /**
     * Save products assigned to a buying guide.
     */
    public function save(
        int $buyingGuideId,
        array $productIds
    ): bool {
        return $this->repository->save(
            $buyingGuideId,
            $productIds
        );
    }
}