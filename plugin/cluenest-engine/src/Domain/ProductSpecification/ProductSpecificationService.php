<?php

declare(strict_types=1);

namespace ClueNest\Domain\ProductSpecification;

use ClueNest\Database\ProductSpecification\ProductSpecificationRepository;

defined('ABSPATH') || exit;

final class ProductSpecificationService
{
    public function __construct(
        private readonly ProductSpecificationRepository $repository = new ProductSpecificationRepository()
    ) {
    }

    /**
     * Save specifications for a product.
     */
    public function save(int $productId, array $specifications): bool
    {
        $specifications = $this->validate($specifications);

        $this->repository->deleteByProductId($productId);

        return $this->repository->save(
            $productId,
            $specifications
        );
    }

    /**
     * Get specifications for a product.
     */
    public function getByProductId(int $productId): array
    {
        return $this->repository->getByProductId($productId);
    }

    /**
     * Validate specifications.
     */
    private function validate(array $specifications): array
    {
        $rows = [];

        foreach ($specifications as $row) {

            $specification = sanitize_text_field(
                trim($row['specification'] ?? '')
            );

            $value = sanitize_text_field(
                trim($row['value'] ?? '')
            );

            if ($specification === '' || $value === '') {
                continue;
            }

            $rows[] = [
                'specification' => $specification,
                'value' => $value,
            ];
        }

        return $rows;
    }
}