<?php

declare(strict_types=1);

namespace ClueNest\Database;

use ClueNest\Database\Tables\ProductsTable;
use ClueNest\Database\Tables\BrandsTable;

defined('ABSPATH') || exit;

final class Schema
{
    public function getTables(): array
    {
        return [
            new ProductsTable(),
            new BrandsTable(),
        ];
    }
}