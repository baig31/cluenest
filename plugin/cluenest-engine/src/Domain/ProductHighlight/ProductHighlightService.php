<?php

declare(strict_types=1);

namespace ClueNest\Domain\ProductHighlight;

use ClueNest\Database\ProductHighlight\ProductHighlightRepository;

defined('ABSPATH') || exit;

final class ProductHighlightService
{
    public function __construct(
        private readonly ProductHighlightRepository $repository = new ProductHighlightRepository()
    ) {
    }

    /**
     * Save highlights.
     */
    public function save(int $productId, array $highlights): bool
    {
        $highlights = $this->validate($highlights);

        $this->repository->deleteByProductId($productId);

        return $this->repository->save(
            $productId,
            $highlights
        );
    }

    /**
     * Get highlights.
     */
    public function getByProductId(int $productId): array
    {
        return $this->repository->getByProductId($productId);
    }

    /**
     * Validate highlights.
     */
    private function validate(array $highlights): array
    {
        $rows = [];

        foreach ($highlights as $highlight) {

            $highlight = sanitize_text_field(
                trim($highlight)
            );

            if ($highlight === '') {
                continue;
            }

            $rows[] = $highlight;
        }

        return $rows;
    }
}