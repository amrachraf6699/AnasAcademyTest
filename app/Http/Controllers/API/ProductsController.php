<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::with('category', 'seller')->paginate(10);

        return $this->SendResponse(
        200,
        'Products retrieved successfully.',
        [
            'pagination' => [
                'total' => $products->total(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
                'next_page' => $products->nextPageUrl(),
                'prev_page' => $products->previousPageUrl(),
                'first_page' => $products->url(1),
                'last_page' => $products->url($products->lastPage())
            ],
            'data' => ProductsResource::collection($products)
        ]
        );
    }
}
