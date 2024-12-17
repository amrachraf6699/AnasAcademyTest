<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterProductsRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(4);

        return view('products.index', compact('products'));
    }

    public function filter(FilterProductsRequest $request)
    {
        $products = Product::where('price', '>=', $request->min_price)->with('category')->paginate(4);

        return view('products.index', compact('products'));
    }
}
