<?php

declare(strict_types=1);

namespace ClueNest\Domain\Brand;

defined('ABSPATH') || exit;

final class BrandService
{
    public function __construct(
        private readonly BrandRepository $repository = new BrandRepository()
    ) {
    }

    public function getAllBrands(): array
    {
        return $this->repository->findAll();
    }

    public function getBrandById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function createBrand(array $data): int
    {
        $data = $this->validate($data);

        return $this->repository->save($data);
    }

    public function updateBrand(int $id, array $data): bool
    {
        $data = $this->validate($data);

        return $this->repository->update($id, $data);
    }

    public function deleteBrand(int $id): bool
    {
        return $this->repository->delete($id);
    }

    private function validate(array $data): array
    {
        $data['name']        = trim($data['name'] ?? '');
        $data['slug']        = trim($data['slug'] ?? '');
        $data['description'] = trim($data['description'] ?? '');
        $data['website']     = trim($data['website'] ?? '');
        $data['logo']        = trim($data['logo'] ?? '');

        // Validate required fields
        if ($data['name'] === '') {
            throw new \InvalidArgumentException('Brand name is required.');
        }

        // Auto-generate slug if empty
        if ($data['slug'] === '') {
            $data['slug'] = sanitize_title($data['name']);
        }

        // Validate status
        $data['status'] = trim($data['status'] ?? 'draft');

        if (! in_array($data['status'], ['publish', 'draft'], true)) {
            $data['status'] = 'draft';
        }

        return $data;
    }
}