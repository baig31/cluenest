<?php

declare(strict_types=1);

namespace ClueNest\Admin\Product;

use ClueNest\Domain\Product\ProductService;

defined('ABSPATH') || exit;

final class ProductController
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    public function index(): void
    {
        $products = $this->service->getAllProducts();

        require CN_PLUGIN_PATH . 'templates/admin/product/index.php';
    }

    public function create(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_create_product');

            $data = [
                'name'   => sanitize_text_field($_POST['name'] ?? ''),
                'slug'   => sanitize_title($_POST['slug'] ?? ''),
                'status' => sanitize_text_field($_POST['status'] ?? 'draft'),
            ];

            try {

                $this->service->createProduct($data);

                wp_redirect(
                    admin_url('admin.php?page=cluenest-products')
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        require CN_PLUGIN_PATH . 'templates/admin/product/create.php';
    }

    /**
     * Edit Product
     */
    public function edit(): void
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        wp_die('Invalid product ID.');
    }

    $product = $this->service->getProductById($id);

    if ($product === null) {
        wp_die('Product not found.');
    }

    if ('POST' === $_SERVER['REQUEST_METHOD']) {

        check_admin_referer('cluenest_update_product');

        $data = [
            'name'   => sanitize_text_field($_POST['name'] ?? ''),
            'slug'   => sanitize_title($_POST['slug'] ?? ''),
            'status' => sanitize_text_field($_POST['status'] ?? 'draft'),
        ];

        try {

            $this->service->updateProduct($id, $data);

            wp_redirect(
                admin_url('admin.php?page=cluenest-products')
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

/**
 * Delete Product
 */
public function delete(): void
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        wp_die('Invalid product ID.');
    }

    check_admin_referer('cluenest_delete_product');

    try {

        $this->service->deleteProduct($id);

        wp_redirect(
            admin_url('admin.php?page=cluenest-products')
        );

        exit;

    } catch (\Throwable $e) {

        wp_die(
            esc_html($e->getMessage())
        );
    }
}



}