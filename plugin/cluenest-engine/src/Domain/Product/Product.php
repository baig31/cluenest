<?php

declare(strict_types=1);

namespace ClueNest\Domain\Product;

defined('ABSPATH') || exit;

final class Product
{
    private ?int $id = null;

    private string $slug = '';

    private string $name = '';

    private ?int $brandId = null;

    private ?int $categoryId = null;

    private ?string $modelNumber = null;

    private ?string $shortDescription = null;

    private ?string $longDescription = null;

    private float $editorialRating = 0.0;

    private string $status = 'draft';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = trim($slug);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    public function setBrandId(?int $brandId): void
    {
        $this->brandId = $brandId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getModelNumber(): ?string
    {
        return $this->modelNumber;
    }

    public function setModelNumber(?string $modelNumber): void
    {
        $this->modelNumber = $modelNumber;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): void
    {
        $this->longDescription = $longDescription;
    }

    public function getEditorialRating(): float
    {
        return $this->editorialRating;
    }

    public function setEditorialRating(float $editorialRating): void
    {
        $this->editorialRating = $editorialRating;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}