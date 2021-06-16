<?php


namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Http\Request;
use Laravel\Lumen\Routing\Controller;

class OrderController extends Controller
{
    public function updateStatus(Request $request, string $orderId): JsonResponse
    {
        $this->validate($request, [
            'occurred_at' => 'required|date',
            'status' => 'required|in:succeeded,failed',
            'reason ' => 'required|in:price_mismatched,pos_item_id_mismatched,items_out_of_stock,location_offline,location_not_supported,unsupported_order_type,other',
            'notes' => 'sometimes|string'
        ]);

        $order = Order::find($orderId);
        if ($order === null)
            abort(404);

        return response()->json();
    }

    public function updateStage(Request $request, string $orderId): JsonResponse
    {
        $this->validate($request, [
            'occurred_at' => 'required|date',
            'stage' => 'required|in:in_kitchen,ready_for_collection,collected'
        ]);

        $order = Order::find($orderId);
        if ($order === null)
            abort(404);

        return response()->json();
    }

    public function show(string $orderId): JsonResponse
    {
        $order = Order::find($orderId);
        if ($order === null)
            abort(404);

        return response()->json($order);

    }
}
