<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

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
    public function getAllOrdersForUser($user)
    {
        if ($user->role === 'admin') {
            return $this->orderRepo->all(); // admin tüm siparişleri alır
        }

        return $this->orderRepo->getByUser($user->id); // müşteri sadece kendi siparişleri
    }

    public function getOrder($id)
    {
        return $this->orderRepo->find($id);
    }



    public function createOrder(array $data)
    {
        try {
            $data['user_id'] = Auth::id();

            $total = 0;
            foreach ($data['items'] as $item) {
                $total += $item['unit_price'] * $item['quantity'];
            }
            $data['total_price'] = $total;

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

        } catch (QueryException $e) {
            // örneğin tablo eksikse, veya column yoksa
            return response()->json([
                'message' => 'Sipariş işlenemedi. Sistemsel bir hata oluştu.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
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
    public function getOrderIfAuthorized($id, $user)
    {
        $order = $this->orderRepo->find($id); // findOrFail → 404

        if ($user->role !== 'admin' && $order->user_id !== $user->id) {
            throw new \Exception('Bu siparişi görüntüleme yetkiniz yok.');
        }

        return $order;
    }
}
