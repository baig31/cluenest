<?php

declare(strict_types=1);

namespace ClueNest\Admin;

defined('ABSPATH') || exit;

final class AdminMenu
{
    public function register(): void
    {
        add_action('admin_menu', [$this, 'registerMenu']);
    }

    public function registerMenu(): void
    {
        add_menu_page(
            'ClueNest',
            'ClueNest',
            'manage_options',
            'cluenest',
            [$this, 'dashboardPage'],
            'dashicons-store',
            25
        );

        add_submenu_page(
            'cluenest',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'cluenest',
            [$this, 'dashboardPage']
        );

        add_submenu_page(
            'cluenest',
            'Products',
            'Products',
            'manage_options',
            'cluenest-products',
            [$this, 'productsPage']
        );

        add_submenu_page(
    null,
    'Add Product',
    'Add Product',
    'manage_options',
    'cluenest-product-create',
    [$this, 'createProductPage']
);

add_submenu_page(
    null,
    'Edit Product',
    'Edit Product',
    'manage_options',
    'cluenest-product-edit',
    [$this, 'editProductPage']
);


add_submenu_page(
    null,
    'Delete Product',
    'Delete Product',
    'manage_options',
    'cluenest-product-delete',
    [$this, 'deleteProductPage']
);

        add_submenu_page(
            'cluenest',
            'Brands',
            'Brands',
            'manage_options',
            'cluenest-brands',
            [$this, 'brandsPage']
        );

        add_submenu_page(
    null,
    'Add Brand',
    'Add Brand',
    'manage_options',
    'cluenest-brand-create',
    [$this, 'createBrandPage']
);

add_submenu_page(
    null,
    'Edit Brand',
    'Edit Brand',
    'manage_options',
    'cluenest-brand-edit',
    [$this, 'editBrandPage']
);

add_submenu_page(
    null,
    'Delete Brand',
    'Delete Brand',
    'manage_options',
    'cluenest-brand-delete',
    [$this, 'deleteBrandPage']
);

        add_submenu_page(
            'cluenest',
            'Categories',
            'Categories',
            'manage_options',
            'cluenest-categories',
            [$this, 'categoriesPage']
        );

        add_submenu_page(
            'cluenest',
            'Buying Guides',
            'Buying Guides',
            'manage_options',
            'cluenest-buying-guides',
            [$this, 'buyingGuidesPage']
        );

        add_submenu_page(
            'cluenest',
            'Comparisons',
            'Comparisons',
            'manage_options',
            'cluenest-comparisons',
            [$this, 'comparisonsPage']
        );

        add_submenu_page(
            'cluenest',
            'Settings',
            'Settings',
            'manage_options',
            'cluenest-settings',
            [$this, 'settingsPage']
        );
    }

    public function dashboardPage(): void
    {
        echo '<div class="wrap"><h1>ClueNest Dashboard</h1><p>Coming Soon...</p></div>';
    }

    public function productsPage(): void
{
    $controller = new \ClueNest\Admin\Product\ProductController();

    $controller->index();
}

public function createProductPage(): void
{
    $controller = new \ClueNest\Admin\Product\ProductController();

    $controller->create();
}


public function editProductPage(): void
{
    $controller = new \ClueNest\Admin\Product\ProductController();

    $controller->edit();
}

public function deleteProductPage(): void
{
    $controller = new \ClueNest\Admin\Product\ProductController();

    $controller->delete();
}


public function createBrandPage(): void
{
    $controller = new \ClueNest\Admin\Brand\BrandController();

    $controller->create();
}

public function editBrandPage(): void
{
    $controller = new \ClueNest\Admin\Brand\BrandController();

    $controller->edit();
}

public function deleteBrandPage(): void
{
    $controller = new \ClueNest\Admin\Brand\BrandController();

    $controller->delete();
}

    public function brandsPage(): void
    {
          $controller = new \ClueNest\Admin\Brand\BrandController();

    $controller->index();
    }

    public function categoriesPage(): void
    {
        echo '<div class="wrap"><h1>Categories</h1><p>Coming Soon...</p></div>';
    }

    public function buyingGuidesPage(): void
    {
        echo '<div class="wrap"><h1>Buying Guides</h1><p>Coming Soon...</p></div>';
    }

    public function comparisonsPage(): void
    {
        echo '<div class="wrap"><h1>Comparisons</h1><p>Coming Soon...</p></div>';
    }

    public function settingsPage(): void
    {
        echo '<div class="wrap"><h1>Settings</h1><p>Coming Soon...</p></div>';
    }
}