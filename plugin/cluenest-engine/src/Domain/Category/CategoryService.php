<?php

declare(strict_types=1);

namespace ClueNest\Domain\Category;

defined('ABSPATH') || exit;

final class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $repository = new CategoryRepository()
    ) {
    }

    public function getAllCategories(): array
    {
        return $this->repository->findAll();
    }

    public function getCategoryById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function createCategory(array $data): int
    {
        $data = $this->validate($data);

        return $this->repository->save($data);
    }

    public function updateCategory(int $id, array $data): bool
    {
        $data = $this->validate($data);

        return $this->repository->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->repository->delete($id);
    }

    private function validate(array $data): array
    {
        $data['parent_id']   = isset($data['parent_id']) && $data['parent_id'] !== ''
            ? (int) $data['parent_id']
            : null;

        $data['name']        = trim($data['name'] ?? '');
        $data['slug']        = trim($data['slug'] ?? '');
        $data['description'] = trim($data['description'] ?? '');

        // Validate required fields
        if ($data['name'] === '') {
            throw new \InvalidArgumentException('Category name is required.');
        }

        // Auto-generate slug if empty
        if ($data['slug'] === '') {
            $data['slug'] = sanitize_title($data['name']);
        }

        // Validate status
        $data['status'] = trim($data['status'] ?? 'draft');

        if (!in_array($data['status'], ['publish', 'draft'], true)) {
            $data['status'] = 'draft';
        }

        return $data;
    }
}