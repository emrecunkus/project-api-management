<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index()
    {
        $user = Auth::user();
        $orders = $this->orderService->getAllOrdersForUser($user);

        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        try {
            $user = Auth::user();
            $order = $this->orderService->getOrderIfAuthorized($id, $user);

            return new OrderResource($order);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Sipariş bulunamadı.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder($request->validated());
        return (new OrderResource($order))->response()->setStatusCode(201);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        try {
            $order = $this->orderService->updateOrder($id, $request->validated());
            return new OrderResource($order);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Sipariş bulunamadı.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->orderService->deleteOrder($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Sipariş bulunamadı.'], 404);
        }
    }
}
