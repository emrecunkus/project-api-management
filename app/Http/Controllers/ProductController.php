<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    public function index()
    {
        return response()->json($this->productService->getAllProducts());
    }

    public function show($id)
    {
        return response()->json($this->productService->getProduct($id));
    }

    public function store(Request $request)
    {
        return response()->json($this->productService->createProduct($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->productService->updateProduct($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(null, 204);
    }
}

