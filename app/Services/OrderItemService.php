<?php
namespace App\Services;

use App\Repositories\OrderItemRepository;

class OrderItemService
{
    public function __construct(private OrderItemRepository $orderItemRepo) {}

    public function createOrderItem(array $data)
    {
        return $this->orderItemRepo->create($data);
    }

    public function deleteOrderItemsByOrder($orderId)
    {
        return $this->orderItemRepo->deleteByOrder($orderId);
    }
}
