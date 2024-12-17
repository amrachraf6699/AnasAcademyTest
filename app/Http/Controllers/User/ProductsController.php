<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()->products()->paginate(10);

        return view('user.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Product::class);

        $categories = Category::all();

        return view('user.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Gate::authorize('create', Product::class);

        $product = auth()->user()->products()->create($request->validated());

        return to_route('myproducts.index')->with('success' , 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $id)
    {
        Gate::authorize('update', $id);

        $id->load('category');

        $categories = Category::all();

        return view('user.products.edit', compact('id', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $id)
    {
        Gate::authorize('update', $id);

        $id->update($request->validated());

        return to_route('myproducts.index')->with('success' , 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $id)
    {
        Gate::authorize('delete', $id);

        $id->delete();

        return back()->with('success' , 'Product deleted successfully');
    }
}
