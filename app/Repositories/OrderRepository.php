<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function all()
    {
        return Order::all();
    }

    public function find($id)
    {
        return Order::findOrFail($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->find($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = $this->find($id);
        $order->delete();
    }
    public function getByUser($userId)
    {
        return Order::where('user_id', $userId)->get();
    }

}
