<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function list(GetProductsRequest $getProductsRequest,ProductService $productService): AnonymousResourceCollection
    {
        return ProductResource::collection($productService->getProducts($getProductsRequest->getPerPage()));
    }
}
