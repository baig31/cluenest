<?php

declare(strict_types=1);

namespace ClueNest\Admin\Product;

use ClueNest\Domain\Product\ProductService;
use ClueNest\Domain\Brand\BrandService;
use ClueNest\Domain\Category\CategoryService;
use ClueNest\Domain\ProductSpecification\ProductSpecificationService;
use ClueNest\Domain\ProductHighlight\ProductHighlightService;
use ClueNest\Domain\ProductProsCons\ProductProsConsService;
use ClueNest\Domain\ProductPricing\ProductPricingService;
use ClueNest\Domain\ProductSeo\ProductSeoService;

defined('ABSPATH') || exit;

final class ProductController
{
    private ProductService $service;
    private BrandService $brandService;
    private CategoryService $categoryService;
    private ProductSpecificationService $productSpecificationService;
    private ProductHighlightService $productHighlightService;
    private ProductProsConsService $productProsConsService;
    private ProductPricingService $productPricingService;
    private ProductSeoService $productSeoService;

   public function __construct()
{
    $this->service = new ProductService();
    $this->brandService = new BrandService();
    $this->categoryService = new CategoryService();
    $this->productSpecificationService = new ProductSpecificationService();
    $this->productHighlightService = new ProductHighlightService();
    $this->productProsConsService = new ProductProsConsService();
    $this->productPricingService = new ProductPricingService();
    $this->productSeoService = new ProductSeoService();
}

    public function index(): void
    {
        $products = $this->service->getAllProducts();

        require CN_PLUGIN_PATH . 'templates/admin/product/index.php';
    }

    public function create(): void
    {
        $brands = $this->brandService->getAllBrands();
        $categories = $this->categoryService->getAllCategories();

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_create_product');

            $data = [
                'brand_id' => isset($_POST['brand_id']) ? (int) $_POST['brand_id'] : null,

                'category_id' => isset($_POST['category_id']) ? (int) $_POST['category_id'] : null,

                'featured_image_id' => isset($_POST['featured_image_id'])
                    ? (int) $_POST['featured_image_id']
                    : null,

                'gallery_image_ids' => isset($_POST['gallery_image_ids'])
                    ? (array) $_POST['gallery_image_ids']
                    : [],

                'name' => sanitize_text_field($_POST['name'] ?? ''),
                'slug' => sanitize_title($_POST['slug'] ?? ''),
                'model_number' => sanitize_text_field($_POST['model_number'] ?? ''),
                'short_description' => wp_kses_post($_POST['short_description'] ?? ''),
                'long_description' => wp_kses_post($_POST['long_description'] ?? ''),
                'editorial_rating' => (float) ($_POST['editorial_rating'] ?? 0),
                'status' => sanitize_text_field($_POST['status'] ?? 'draft'),
            ];

            try {

                $productId = $this->service->createProduct($data);

                $prosCons = $this->getProsConsFromRequest();

$this->productProsConsService->save(
    $productId,
    $prosCons
);

$this->productPricingService->save(
    $productId,
    $this->getPricingFromRequest()
);

$this->productSeoService->save(
    $productId,
    $this->getSeoFromRequest()
);

                $specifications = $this->getSpecificationsFromRequest();

$this->productSpecificationService->save(
    $productId,
    $specifications
);

$this->productHighlightService->save(
    $productId,
    $this->getHighlightsFromRequest()
);

                wp_safe_redirect(
                    admin_url('admin.php?page=cluenest-products&message=created')
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        $product = (object) [];
        $specifications = [];
        $highlights = [];
        $prosCons = [];
        $pricing = null;
        $seo = null;

        require CN_PLUGIN_PATH . 'templates/admin/product/create.php';
    }

    public function edit(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            wp_die('Invalid product ID.');
        }

        $product = $this->service->getProductById($id);
        $specifications = $this->productSpecificationService
    ->getByProductId($id);

    $highlights = $this->productHighlightService
    ->getByProductId($id);

    $prosCons = $this->productProsConsService
    ->getByProductId($id);

    $pricing = $this->productPricingService
    ->getByProductId($id);

    $seo = $this->productSeoService
    ->getByProductId($id);

        if ($product === null) {
            wp_die('Product not found.');
        }

        $brands = $this->brandService->getAllBrands();
        $categories = $this->categoryService->getAllCategories();

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_update_product');

            $data = [
                'brand_id' => isset($_POST['brand_id']) ? (int) $_POST['brand_id'] : null,

                'category_id' => isset($_POST['category_id']) ? (int) $_POST['category_id'] : null,

                'featured_image_id' => isset($_POST['featured_image_id'])
                    ? (int) $_POST['featured_image_id']
                    : null,

                'gallery_image_ids' => isset($_POST['gallery_image_ids'])
                    ? (array) $_POST['gallery_image_ids']
                    : [],

                'name' => sanitize_text_field($_POST['name'] ?? ''),
                'slug' => sanitize_title($_POST['slug'] ?? ''),
                'model_number' => sanitize_text_field($_POST['model_number'] ?? ''),
                'short_description' => wp_kses_post($_POST['short_description'] ?? ''),
                'long_description' => wp_kses_post($_POST['long_description'] ?? ''),
                'editorial_rating' => (float) ($_POST['editorial_rating'] ?? 0),
                'status' => sanitize_text_field($_POST['status'] ?? 'draft'),
            ];

            try {

                $this->service->updateProduct($id, $data);

                $specifications = $this->getSpecificationsFromRequest();

$this->productSpecificationService->save(
    $id,
    $specifications
);

$this->productHighlightService->save(
    $id,
    $this->getHighlightsFromRequest()
);

$this->productProsConsService->save(
    $id,
    $this->getProsConsFromRequest()
);

$this->productPricingService->save(
    $id,
    $this->getPricingFromRequest()
);

$this->productSeoService->save(
    $id,
    $this->getSeoFromRequest()
);



                wp_safe_redirect(
                    admin_url('admin.php?page=cluenest-products&message=updated')
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        require CN_PLUGIN_PATH . 'templates/admin/product/edit.php';
    }

    public function delete(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            wp_die('Invalid product ID.');
        }

        check_admin_referer('cluenest_delete_product');

        try {

            $this->service->deleteProduct($id);

            wp_safe_redirect(
                admin_url('admin.php?page=cluenest-products&message=deleted')
            );

            exit;

        } catch (\Throwable $e) {

            wp_die(
                esc_html($e->getMessage())
            );
        }
    }

    private function getSpecificationsFromRequest(): array
{
    $specifications = $_POST['specification'] ?? [];
    $values = $_POST['value'] ?? [];

    $rows = [];

    foreach ($specifications as $index => $specification) {
    $rows[] = [
        'specification' => sanitize_text_field($specification),
        'value' => sanitize_text_field($values[$index] ?? ''),
    ];
}

    return $rows;
}

private function getHighlightsFromRequest(): array
{
    return $_POST['highlight'] ?? [];
}

private function getProsConsFromRequest(): array
{
    $types = $_POST['pros_cons_type'] ?? [];
    $contents = $_POST['pros_cons_content'] ?? [];

    $rows = [];

    foreach ($types as $index => $type) {

        $rows[] = [
            'type' => sanitize_text_field($type),
            'content' => sanitize_text_field(
                $contents[$index] ?? ''
            ),
        ];
    }

    return $rows;
}

private function getPricingFromRequest(): array
{
    return [
        'price' => $_POST['price'] ?? '',
        'original_price' => $_POST['original_price'] ?? '',
        'affiliate_url' => $_POST['affiliate_url'] ?? '',
        'affiliate_network' => $_POST['affiliate_network'] ?? '',
        'currency' => $_POST['currency'] ?? 'INR',
    ];
}

private function getSeoFromRequest(): array
{
    return [
        'seo_title' => $_POST['seo_title'] ?? '',
        'meta_description' => $_POST['meta_description'] ?? '',
        'focus_keyword' => $_POST['focus_keyword'] ?? '',
        'canonical_url' => $_POST['canonical_url'] ?? '',
        'robots_index' => $_POST['robots_index'] ?? 'index',
    ];
}

}