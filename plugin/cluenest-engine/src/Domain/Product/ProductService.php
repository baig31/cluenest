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
    public function getProductById(int $id): ?object
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
    $data['brand_id'] = !empty($data['brand_id'])
        ? (int) $data['brand_id']
        : null;

    $data['category_id'] = !empty($data['category_id'])
        ? (int) $data['category_id']
        : null;

    $data['featured_image_id'] = !empty($data['featured_image_id'])
        ? (int) $data['featured_image_id']
        : null;

    $data['name'] = sanitize_text_field(trim($data['name'] ?? ''));

    $data['slug'] = sanitize_title($data['slug'] ?? '');

    $data['model_number'] = sanitize_text_field(trim($data['model_number'] ?? ''));

    $data['short_description'] = wp_kses_post($data['short_description'] ?? '');

    $data['long_description'] = wp_kses_post($data['long_description'] ?? '');

    $data['editorial_rating'] = isset($data['editorial_rating'])
        ? (float) $data['editorial_rating']
        : 0;

    $data['status'] = trim($data['status'] ?? 'draft');

    if ($data['name'] === '') {
        throw new \InvalidArgumentException('Product name is required.');
    }

    if ($data['slug'] === '') {
        $data['slug'] = sanitize_title($data['name']);
    }

    if ($data['editorial_rating'] < 0 || $data['editorial_rating'] > 5) {
        throw new \InvalidArgumentException(
            'Editorial rating must be between 0 and 5.'
        );
    }

    if (!in_array($data['status'], ['draft', 'publish'], true)) {
        $data['status'] = 'draft';
    }

    return $data;
}
}