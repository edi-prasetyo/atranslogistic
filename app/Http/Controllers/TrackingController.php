<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {

        $receipt_number = $request['receipt_number'];
        $order = Order::where('receipt_number', $receipt_number)->first();

        $trackings = Tracking::where('order_id', $order->id)->get();

        // return $trackings;

        return view('frontends.tracking', compact('trackings'));
    }
}
