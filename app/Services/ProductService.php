<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepo) {}

    public function getAllProducts()
    {
        return $this->productRepo->all();
    }

    public function getProduct($id)
    {
        return $this->productRepo->find($id);
    }

    public function createProduct(array $data)
    {
        return $this->productRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepo->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepo->delete($id);
    }
}

