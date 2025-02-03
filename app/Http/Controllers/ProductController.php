<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with(['brand'])->orderBy('id', 'desc')->paginate(10);
        return response()->json($products);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $imagePath = null;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('products', 'public');
        }
        $productData = array_merge($request->validated(), ['photo' => $imagePath]);

        // Create product
        $product = Product::create($productData);
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $product = Product::with(['cat_info', 'sub_cat_info', 'brand', 'getReview'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully.',
            'data' => $product
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }
}
