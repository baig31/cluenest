<?php

declare(strict_types=1);

namespace ClueNest\Domain\BuyingGuide;

use ClueNest\Database\BuyingGuide\BuyingGuideRepository;

defined('ABSPATH') || exit;

final class BuyingGuideService
{
    public function __construct(
        private readonly BuyingGuideRepository $repository = new BuyingGuideRepository()
    ) {
    }

    /**
     * Get all buying guides.
     */
    public function getAllGuides(): array
    {
        return $this->repository->getAll();
    }

    /**
     * Get a buying guide by ID.
     */
    public function getGuideById(int $id): ?object
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a buying guide.
     */
    public function createGuide(array $data): int
    {
        $data = $this->validate($data);

        return $this->repository->create($data);
    }

    /**
     * Update a buying guide.
     */
    public function updateGuide(int $id, array $data): bool
    {
        $data = $this->validate($data);

        return $this->repository->update($id, $data);
    }

    /**
     * Delete a buying guide.
     */
    public function deleteGuide(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Validate and sanitize guide data.
     */
    private function validate(array $data): array
    {
        return [
            'category_id' => !empty($data['category_id'])
                ? (int) $data['category_id']
                : null,

            'featured_image_id' => !empty($data['featured_image_id'])
                ? (int) $data['featured_image_id']
                : null,

            'slug' => sanitize_title(
                $data['slug'] ?? ''
            ),

            'title' => sanitize_text_field(
                $data['title'] ?? ''
            ),

            'short_description' => sanitize_textarea_field(
                $data['short_description'] ?? ''
            ),

            'content' => wp_kses_post(
                $data['content'] ?? ''
            ),

            'status' => in_array(
                $data['status'] ?? 'draft',
                ['draft', 'publish'],
                true
            )
                ? $data['status']
                : 'draft',
        ];
    }
}