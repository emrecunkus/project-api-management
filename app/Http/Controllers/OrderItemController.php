<?php

namespace App\Http\Controllers;

use App\Services\OrderItemService;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function __construct(private OrderItemService $orderItemService) {}

    public function store(Request $request)
    {
        return response()->json($this->orderItemService->createOrderItem($request->all()), 201);
    }

    public function destroy($orderId)
    {
        $this->orderItemService->deleteOrderItemsByOrder($orderId);
        return response()->json(null, 204);
    }
}
