<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $order->courier_id = $request['courier_id'];
        $order->status = $request['status'];
        $order->update();

        // $courier_id = $order->courier_id;
        $courier_name = User::where('id', $order->courier_id)->first();


        $tracking = new Tracking();
        $tracking->order_id = $order->id;
        $tracking->courier_id = $order->courier_id;
        $tracking->stage = "Order telah di Antar oleh " . $courier_name->name;
        $tracking->save();

        if ($order) {
            return response()->json([
                'status' => 'Success',
                'message' => '',
                'data' => $order
            ]);
        }
    }

    public function kurir()
    {
        $courier_id = Auth::user()->id;
        $order_kurir = Order::where('courier_id', $courier_id)->where('status', 1)->get();
        if ($order_kurir) {
            return response()->json([
                'status' => 'Success',
                'message' => '',
                'data' => $order_kurir
            ]);
        }
    }
}
