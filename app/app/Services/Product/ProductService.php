<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Models\Product\Product;
use Illuminate\Contracts\Pagination\CursorPaginator;

class ProductService
{
    public const int DEFAULT_PER_PAGE = 15;
    public function getProducts(?int $perPage = self::DEFAULT_PER_PAGE): CursorPaginator
    {
        return Product::query()
            ->with('category')
            ->cursorPaginate(perPage: $perPage);
    }
}
