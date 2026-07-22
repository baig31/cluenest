<?php

declare(strict_types=1);

namespace ClueNest\Admin\Category;

use ClueNest\Domain\Category\CategoryService;

defined('ABSPATH') || exit;

final class CategoryController
{
    private CategoryService $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    public function index(): void
    {
        $categories = $this->service->getAllCategories();

        require CN_PLUGIN_PATH . 'templates/admin/category/index.php';
    }

    public function create(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_create_category');

            $data = [
                'parent_id'   => isset($_POST['parent_id']) ? (int) $_POST['parent_id'] : null,
                'name'        => sanitize_text_field($_POST['name'] ?? ''),
                'slug'        => sanitize_title($_POST['slug'] ?? ''),
                'description' => sanitize_textarea_field($_POST['description'] ?? ''),
                'status'      => sanitize_text_field($_POST['status'] ?? 'draft'),
            ];

            try {

                $this->service->createCategory($data);

                wp_safe_redirect(
                    admin_url('admin.php?page=cluenest-categories&message=created')
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        $category = [];

        require CN_PLUGIN_PATH . 'templates/admin/category/create.php';
    }

    public function edit(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            wp_die('Invalid category ID.');
        }

        $category = $this->service->getCategoryById($id);

        if ($category === null) {
            wp_die('Category not found.');
        }

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            check_admin_referer('cluenest_update_category');

            $data = [
                'parent_id'   => isset($_POST['parent_id']) ? (int) $_POST['parent_id'] : null,
                'name'        => sanitize_text_field($_POST['name'] ?? ''),
                'slug'        => sanitize_title($_POST['slug'] ?? ''),
                'description' => sanitize_textarea_field($_POST['description'] ?? ''),
                'status'      => sanitize_text_field($_POST['status'] ?? 'draft'),
            ];

            try {

                $this->service->updateCategory($id, $data);

                wp_safe_redirect(
                    admin_url('admin.php?page=cluenest-categories&message=updated')
                );

                exit;

            } catch (\Throwable $e) {

                echo '<div class="notice notice-error"><p>' .
                    esc_html($e->getMessage()) .
                    '</p></div>';
            }
        }

        require CN_PLUGIN_PATH . 'templates/admin/category/edit.php';
    }

    public function delete(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            wp_die('Invalid category ID.');
        }

        check_admin_referer('cluenest_delete_category');

        try {

            $this->service->deleteCategory($id);

            wp_safe_redirect(
                admin_url('admin.php?page=cluenest-categories&message=deleted')
            );

            exit;

        } catch (\Throwable $e) {

            wp_die(
                esc_html($e->getMessage())
            );
        }
    }
}