<?php

declare(strict_types=1);

namespace ClueNest\Database;

use ClueNest\Database\Tables\ProductsTable;
use ClueNest\Database\Tables\BrandsTable;
use ClueNest\Database\Tables\CategoriesTable;
use ClueNest\Database\Tables\ProductSpecificationsTable;
use ClueNest\Database\Tables\ProductHighlightsTable;
use ClueNest\Database\Tables\ProductProsConsTable;
use ClueNest\Database\Tables\ProductPricingTable;
use ClueNest\Database\Tables\ProductSeoTable;

defined('ABSPATH') || exit;

final class Schema
{
    public function getTables(): array
    {
        return [
            new ProductsTable(),
            new BrandsTable(),
            new CategoriesTable(),
            new ProductSpecificationsTable(),
            new ProductHighlightsTable(),
            new ProductProsConsTable(),
            new ProductPricingTable(),
             new ProductSeoTable(),
        ];
    }
}