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
     * Get a single product.
     */
    public function getProductById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a product.
     */
    public function createProduct(array $data): int
    {
        $data = $this->validate($data);

        return $this->repository->save($data);
    }

    /**
     * Update a product.
     */
    public function updateProduct(int $id, array $data): bool
    {
        $data = $this->validate($data);

        return $this->repository->update($id, $data);
    }

    /**
 * Delete a product.
 */
public function deleteProduct(int $id): bool
{
    return $this->repository->delete($id);
}

    /**
     * Validate product data.
     */
    private function validate(array $data): array
    {
        $data['name'] = trim($data['name'] ?? '');
        $data['slug'] = trim($data['slug'] ?? '');
        $data['status'] = $data['status'] ?? 'draft';

        if ($data['name'] === '') {
            throw new \InvalidArgumentException('Product name is required.');
        }

        if ($data['slug'] === '') {
            throw new \InvalidArgumentException('Product slug is required.');
        }

        return $data;
    }
}