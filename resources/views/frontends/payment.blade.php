@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <img src="{{ url($order->qrcode) }}"><br>
                {{ $order->receipt_number }}
            </div>
        </div>
    </div>
@endsection
