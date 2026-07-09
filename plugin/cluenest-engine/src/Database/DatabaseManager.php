<?php

declare(strict_types=1);

namespace ClueNest\Database;

defined('ABSPATH') || exit;

final class DatabaseManager
{
    public static function getPrefix(): string
    {
        global $wpdb;

        return $wpdb->prefix . 'cn_';
    }

    public static function getProductsTable(): string
    {
        return self::getPrefix() . 'products';
    }

    public static function getBrandsTable(): string
    {
        return self::getPrefix() . 'brands';
    }

    public static function getCategoriesTable(): string
    {
        return self::getPrefix() . 'categories';
    }
}