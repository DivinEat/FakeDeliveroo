<?php


namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Http\Request;
use Laravel\Lumen\Routing\Controller;

class OrderController extends Controller
{
    public function updateStatus(Request $request, string $order_id): JsonResponse
    {
        $status = $this->validate($request, [
            'occurred_at' => 'required|date',
            'status' => 'required|in:succeeded,failed',
            'reason ' => 'required|in:price_mismatched,pos_item_id_mismatched,items_out_of_stock,location_offline,location_not_supported,unsupported_order_type,other',
            'notes' => 'sometimes|string'
        ]);
        /** @var Order $order */
        $order = Order::find($order_id);
        if ($order === null)
            abort(404);

        $order->order_sync_statuses[] = $status;
        $order->save();

        return response();
    }

    public function updateStage(Request $request, string $order_id): JsonResponse
    {
        $stage = $this->validate($request, [
            'occurred_at' => 'required|date',
            'stage' => 'required|in:in_kitchen,ready_for_collection,collected'
        ]);
        /** @var Order $order */
        $order = Order::find($order_id);
        if ($order === null)
            abort(404);
        $order->order_prep_stages[] = $stage;
        $order->save();

        return response();
    }

    public function show(string $order_id): JsonResponse
    {
        $order = Order::find($order_id);
        if ($order === null)
            abort(404);

        return response()->json($order);
    }
}
