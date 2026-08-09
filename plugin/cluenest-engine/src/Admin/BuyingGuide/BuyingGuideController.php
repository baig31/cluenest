<?php

declare(strict_types=1);

namespace ClueNest\Admin\BuyingGuide;

use ClueNest\Domain\BuyingGuide\BuyingGuideService;
use ClueNest\Domain\Category\CategoryService;
use ClueNest\Domain\BuyingGuide\BuyingGuideProductService;
use ClueNest\Domain\Product\ProductService;

defined('ABSPATH') || exit;

final class BuyingGuideController
{
    private BuyingGuideService $service;
    private CategoryService $categoryService;
    private BuyingGuideProductService $buyingGuideProductService;
    private ProductService $productService;

    public function __construct()
    {
        $this->service = new BuyingGuideService();
        $this->categoryService = new CategoryService();
        $this->buyingGuideProductService = new BuyingGuideProductService();
        $this->productService = new ProductService();
    }

    /**
     * List buying guides.
     */
    public function index(): void
    {
        $guides = $this->service->getAllGuides();

        require CN_PLUGIN_PATH . 'templates/admin/buying-guide/index.php';
    }

    /**
     * Create buying guide.
     */
    public function create(): void
    {
        $categories = $this->categoryService->getAllCategories();

        $products = $this->productService->getAllProducts();

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_create_buying_guide');

            $data = [
                'category_id' => isset($_POST['category_id'])
                    ? (int) $_POST['category_id']
                    : null,

                'featured_image_id' => isset($_POST['featured_image_id'])
                    ? (int) $_POST['featured_image_id']
                    : null,

                'title' => sanitize_text_field(
                    $_POST['title'] ?? ''
                ),

                'slug' => sanitize_title(
                    $_POST['slug'] ?? ''
                ),

                'short_description' => sanitize_textarea_field(
                    $_POST['short_description'] ?? ''
                ),

                'content' => wp_kses_post(
                    $_POST['content'] ?? ''
                ),

                'status' => sanitize_text_field(
                    $_POST['status'] ?? 'draft'
                ),
            ];

            try {

                $guideId = $this->service->createGuide($data);

                $this->buyingGuideProductService->save(
                    $guideId,
                    $this->getProductIdsFromRequest()
                );

                wp_safe_redirect(
                    admin_url(
                        'admin.php?page=cluenest-buying-guides&message=created'
                    )
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        $guide = (object) [];

        $relatedProducts = [];

        require CN_PLUGIN_PATH . 'templates/admin/buying-guide/create.php';
    }

    /**
     * Edit buying guide.
     */
    public function edit(): void
    {
        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            wp_die('Invalid buying guide ID.');
        }

        $guide = $this->service->getGuideById($id);

        if ($guide === null) {
            wp_die('Buying guide not found.');
        }

        $categories = $this->categoryService->getAllCategories();

        $products = $this->productService->getAllProducts();

        $relatedProducts = $this->buyingGuideProductService
            ->getByBuyingGuideId($id);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_update_buying_guide');

            $data = [
                'category_id' => isset($_POST['category_id'])
                    ? (int) $_POST['category_id']
                    : null,

                'featured_image_id' => isset($_POST['featured_image_id'])
                    ? (int) $_POST['featured_image_id']
                    : null,

                'title' => sanitize_text_field(
                    $_POST['title'] ?? ''
                ),

                'slug' => sanitize_title(
                    $_POST['slug'] ?? ''
                ),

                'short_description' => sanitize_textarea_field(
                    $_POST['short_description'] ?? ''
                ),

                'content' => wp_kses_post(
                    $_POST['content'] ?? ''
                ),

                'status' => sanitize_text_field(
                    $_POST['status'] ?? 'draft'
                ),
            ];

            try {

                $this->service->updateGuide(
                    $id,
                    $data
                );

                $this->buyingGuideProductService->save(
                    $id,
                    $this->getProductIdsFromRequest()
                );

                wp_safe_redirect(
                    admin_url(
                        'admin.php?page=cluenest-buying-guides&message=updated'
                    )
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        require CN_PLUGIN_PATH . 'templates/admin/buying-guide/edit.php';
    }

    /**
     * Delete buying guide.
     */
    public function delete(): void
    {
        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            wp_die('Invalid buying guide ID.');
        }

        check_admin_referer('cluenest_delete_buying_guide');

        try {

            $this->service->deleteGuide($id);

            wp_safe_redirect(
                admin_url(
                    'admin.php?page=cluenest-buying-guides&message=deleted'
                )
            );

            exit;

        } catch (\Throwable $e) {

            wp_die(
                esc_html($e->getMessage())
            );
        }
    }

    /**
     * Get selected product IDs from request.
     */
    private function getProductIdsFromRequest(): array
    {
        $productIds = $_POST['product_ids'] ?? [];

        if (!is_array($productIds)) {
            return [];
        }

        return array_values(
            array_filter(
                array_map(
                    'intval',
                    $productIds
                )
            )
        );
    }
}