<?php

namespace App\Http\Controllers\Api;

use App\Actions\StoreOrUpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $product = Product::paginate();
        return ProductResource::collection($product);
    }

    public function store(ProductRequest $request, StoreOrUpdateProductAction $storeAction): ProductResource 
    {
        $product = $storeAction->execute($request->validated(), new Product());
        
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product, StoreOrUpdateProductAction $updateAction): ProductResource
    {
        $product = $updateAction->execute($request->validated(), $product);

        return new ProductResource($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            "message" => 'Product Removed'
        ]);
    }
}
