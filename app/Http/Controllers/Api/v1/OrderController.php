<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {

        // $users = User::role('writer')->get(); 
        $orders = Order::all();
        if ($orders) {
            return response()->json([
                'status' => 'Success',
                'message' => '',
                'data' => $orders
            ]);
        }
    }
    public function update(Request $request, String $uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        $order->user_id = $request['user_id'];
        $order->update();

        if ($order) {
            return response()->json([
                'status' => 'Success',
                'message' => '',
                'data' => $order
            ]);
        }
    }
}
