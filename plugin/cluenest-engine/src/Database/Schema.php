<?php

declare(strict_types=1);

namespace ClueNest\Database;

use ClueNest\Database\Tables\ProductsTable;
use ClueNest\Database\Tables\BrandsTable;
use ClueNest\Database\Tables\CategoriesTable;

defined('ABSPATH') || exit;

final class Schema
{
    public function getTables(): array
    {
        return [
            new ProductsTable(),
            new BrandsTable(),
            new CategoriesTable(),
        ];
    }
}