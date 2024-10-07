<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tracking;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function show($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $tracking = Tracking::where('order_id', $order_id)->get();
        return view('admin.orders.show', compact('order', 'tracking'));
    }

    public function tracking($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $tracking = Tracking::where('order_id', $order_id)->get();
        return view('admin.orders.tracking', compact('order', 'tracking'));
    }

    public function update($uuid) {}
}
