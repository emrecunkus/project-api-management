<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProduct($id);
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    }
}
