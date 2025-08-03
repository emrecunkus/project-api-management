<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function __construct(private ProductRepository $productRepo) {}

    // cached with redis
    public function getAllProducts()
    {
        return Cache::remember('products', 60, function () {
            return $this->productRepo->all();
        });
    }

    public function getProduct($id)
    {
        return $this->productRepo->find($id);
    }

    public function createProduct(array $data)
    {
        Cache::forget('products');
        return $this->productRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        Cache::forget('products');
        return $this->productRepo->update($id, $data);
    }

    public function deleteProduct($id)
    {
        Cache::forget('products');
        return $this->productRepo->delete($id);
    }
}

