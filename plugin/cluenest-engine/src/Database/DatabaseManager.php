<?php

declare(strict_types=1);

namespace ClueNest\Database;

defined('ABSPATH') || exit;

final class DatabaseManager
{
    public static function getPrefix(): string
    {
        global $wpdb;

        return $wpdb->prefix;
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



    public static function getProductSpecificationsTable(): string
{
    return self::getPrefix() . 'product_specifications';
}

public static function getProductHighlightsTable(): string
{
    return self::getPrefix() . 'product_highlights';
}

public static function getProductPricingTable(): string
{
    return self::getPrefix() . 'product_pricing';
}

public static function getProductSeoTable(): string
{
    return self::getPrefix() . 'product_seo';
}

public static function getBuyingGuidesTable(): string
{
    return self::getPrefix() . 'buying_guides';
}

public static function getBuyingGuideProductsTable(): string
{
    return self::getPrefix() . 'buying_guide_products';
}


public static function getProductProsConsTable(): string
{
    return self::getPrefix() . 'product_pros_cons';
}


}