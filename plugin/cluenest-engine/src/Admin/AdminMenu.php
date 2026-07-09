<?php

declare(strict_types=1);

namespace ClueNest\Admin;

defined('ABSPATH') || exit;

class AdminMenu
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
            'cluenest',
            'Brands',
            'Brands',
            'manage_options',
            'cluenest-brands',
            [$this, 'brandsPage']
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
        echo '<div class="wrap"><h1>Products</h1><p>Coming Soon...</p></div>';
    }

    public function brandsPage(): void
    {
        echo '<div class="wrap"><h1>Brands</h1><p>Coming Soon...</p></div>';
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