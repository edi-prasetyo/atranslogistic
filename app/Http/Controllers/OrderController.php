<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Tracking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $origin = $request['origin'];
        $destination = $request['destination'];
        $total_price = $request['total_price'];
        $vehicle_name = $request['vehicle_name'];
        if ($origin == '') {
            return redirect('tarif');
        } else {
            return view('frontends.order', compact('origin', 'destination', 'total_price', 'vehicle_name', 'categories'));
        }
    }
    public function store(Request $request)
    {

        $receipt_number = random_int(1000000, 9999999);
        $uuid = $uuid =  $uuid = Str::uuid()->toString();
        // $validated = $request->validate([
        //     'shipper_name' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        //     'shipper_phone' => 'required',
        // ]);

        $order = new Order();

        $order->uuid = $uuid;
        $order->shipper_name = $request['shipper_name'];
        $order->shipper_phone = $request['shipper_phone'];
        $order->city_origin = $request['city_origin'];
        $order->shipper_address = $request['shipper_address'];
        $order->recipient_name = $request['recipient_name'];
        $order->recipient_phone = $request['recipient_phone'];
        $order->city_destination = $request['city_destination'];
        $order->recipient_address = $request['recipient_address'];

        $order->category_name = $request['category_name'];
        $order->item_name = $request['item_name'];
        $order->vehicle_name = $request['vehicle_name'];

        $order->price = $request['price'];
        $order->total_price = $request['total_price'];
        $order->receipt_number = $receipt_number;

        $path = 'uploads/qrcode/';
        $file = $path . $order->uuid . '.svg';
        $qr = QrCode::format('svg')->generate($order->uuid, $file);

        $order->qrcode = $file;
        $order->save();

        $tracking = new Tracking();
        $tracking->order_id = $order->id;
        $tracking->stage = "Order telah di Buat di " . $order->city_origin;
        $tracking->save();

        return redirect('order/payment/' . $order->uuid);
    }

    public function payment($uuid)
    {
        $order = Order::where('uuid', $uuid)->first();

        return view('frontends.payment', compact('order'));
    }
}
