<?php

declare(strict_types=1);

namespace ClueNest\Domain\Product;

defined('ABSPATH') || exit;

final class ProductService
{
    public function __construct(
        private readonly ProductRepository $repository = new ProductRepository()
    ) {
    }

    /**
     * Get all products.
     */
    public function getAllProducts(): array
    {
        return $this->repository->findAll();
    }

    /**
     * Create a new product.
     */
    public function createProduct(array $data): int
    {
        // Basic validation

        $data['name'] = trim($data['name'] ?? '');
        $data['slug'] = trim($data['slug'] ?? '');
        $data['status'] = $data['status'] ?? 'draft';

        if ($data['name'] === '') {
            throw new \InvalidArgumentException('Product name is required.');
        }

        if ($data['slug'] === '') {
            throw new \InvalidArgumentException('Product slug is required.');
        }

        return $this->repository->save($data);
    }
}