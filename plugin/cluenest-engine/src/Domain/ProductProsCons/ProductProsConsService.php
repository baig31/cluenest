<?php

declare(strict_types=1);

namespace ClueNest\Domain\ProductProsCons;

use ClueNest\Database\ProductProsCons\ProductProsConsRepository;

defined('ABSPATH') || exit;

final class ProductProsConsService
{
    public function __construct(
        private readonly ProductProsConsRepository $repository = new ProductProsConsRepository()
    ) {
    }

    /**
     * Save product pros and cons.
     */
    public function save(int $productId, array $items): bool
    {
        $items = $this->validate($items);

        $this->repository->deleteByProductId($productId);

        return $this->repository->save(
            $productId,
            $items
        );
    }

    /**
     * Get pros and cons for a product.
     */
    public function getByProductId(int $productId): array
    {
        return $this->repository->getByProductId($productId);
    }

    /**
     * Validate pros and cons.
     */
    private function validate(array $items): array
    {
        $rows = [];

        foreach ($items as $item) {

            $type = sanitize_text_field(
                trim($item['type'] ?? '')
            );

            $content = sanitize_text_field(
                trim($item['content'] ?? '')
            );

            if (!in_array($type, ['pro', 'con'], true)) {
                continue;
            }

            if ($content === '') {
                continue;
            }

            $rows[] = [
                'type' => $type,
                'content' => $content,
            ];
        }

        return $rows;
    }
}