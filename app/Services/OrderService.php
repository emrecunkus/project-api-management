<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepo,
        private OrderItemRepository $orderItemRepo
    ) {}

    public function getAllOrders()
    {
        return $this->orderRepo->all();
    }

    public function getOrder($id)
    {
        return $this->orderRepo->find($id);
    }

    public function createOrder(array $data)
    {
        $order = $this->orderRepo->create($data);
        foreach ($data['items'] as $item) {
            $this->orderItemRepo->create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }
        return $order;
    }

    public function updateOrder($id, array $data)
    {
        return $this->orderRepo->update($id, $data);
    }

    public function deleteOrder($id)
    {
        $this->orderItemRepo->deleteByOrder($id);
        return $this->orderRepo->delete($id);
    }
}
