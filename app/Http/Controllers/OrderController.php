<?php
namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index()
    {
        return response()->json($this->orderService->getAllOrders());
    }

    public function show($id)
    {
        return response()->json($this->orderService->getOrder($id));
    }

    public function store(Request $request)
    {
        return response()->json($this->orderService->createOrder($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->orderService->updateOrder($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return response()->json(null, 204);
    }
}
