<?php

declare(strict_types=1);

namespace ClueNest\Admin\Brand;

use ClueNest\Domain\Brand\BrandService;

defined('ABSPATH') || exit;

final class BrandController
{
    private BrandService $service;

    public function __construct()
    {
       $this->service = new BrandService();
    }

    public function index(): void
    {
        $brands = $this->service->getAllBrands();

require CN_PLUGIN_PATH . 'templates/admin/brand/index.php';
    }

    public function create(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_create_brand');

            $data = [
    'name'        => sanitize_text_field($_POST['name'] ?? ''),
    'slug'        => sanitize_title($_POST['slug'] ?? ''),
    'description' => sanitize_textarea_field($_POST['description'] ?? ''),
    'website'     => esc_url_raw($_POST['website'] ?? ''),
    'logo'        => esc_url_raw($_POST['logo'] ?? ''),
    'status'      => sanitize_text_field($_POST['status'] ?? 'draft'),
];

            try {

                $this->service->createBrand($data);

             wp_safe_redirect(
    admin_url('admin.php?page=cluenest-brands&message=created')
);

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }
$brand = [];
        require CN_PLUGIN_PATH . 'templates/admin/brand/create.php';
    }

    /**
     * Edit Brand
     */
    public function edit(): void
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        wp_die('Invalid brand ID.');
    }

    $brand = $this->service->getBrandById($id);

    if ($brand === null) {
        wp_die('Brand not found.');
    }

    if ('POST' === $_SERVER['REQUEST_METHOD']) {

        check_admin_referer('cluenest_update_brand');

        $data = [
    'name'        => sanitize_text_field($_POST['name'] ?? ''),
    'slug'        => sanitize_title($_POST['slug'] ?? ''),
    'description' => sanitize_textarea_field($_POST['description'] ?? ''),
    'website'     => esc_url_raw($_POST['website'] ?? ''),
    'logo'        => esc_url_raw($_POST['logo'] ?? ''),
    'status'      => sanitize_text_field($_POST['status'] ?? 'draft'),
];

        try {

            $this->service->updateBrand($id, $data);

           wp_safe_redirect(
    admin_url('admin.php?page=cluenest-brands&message=updated')
);

            exit;

        } catch (\Throwable $e) {

            echo '<div class="notice notice-error"><p>' .
                esc_html($e->getMessage()) .
                '</p></div>';
        }
    }

    require CN_PLUGIN_PATH . 'templates/admin/brand/edit.php';
}

/**
 * Delete Brand
 */
public function delete(): void
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        wp_die('Invalid brand ID.');
    }

    check_admin_referer('cluenest_delete_brand');

    try {

        $this->service->deleteBrand($id);

       wp_safe_redirect(
    admin_url('admin.php?page=cluenest-brands&message=deleted')
);

        exit;

    } catch (\Throwable $e) {

        wp_die(
            esc_html($e->getMessage())
        );
    }
}



}