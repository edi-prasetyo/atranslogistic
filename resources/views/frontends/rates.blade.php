@extends('layouts.front')
@section('content')
    <section class="boot-elemant-bg hero"
        style="background-color:darkblue;height: 250px;background-position: 80% 30%; background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9)), url({{ url('uploads/images/bg.webp') }});">
        <div class="container position-relative py-md-5 py-0">
            <div class="row">
                <div class="container" style="position: absolute;">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text-left text-white">
                                <h1><b> Cek Tarif Jasa Pengiriman Paket di Jabodetabek.</b></h1>
                                {{-- <p>Temukan Agen Atrans Express di kota anda.</p> --}}
                                <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> -->
                            </div>
                        </div>
                        <div class="col-md-5">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="elemant-bg-overlay black"></div>
        {{-- <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
            <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
        </svg> --}}
    </section>

    <section class="py-5 bg-body">
        <div class="container cek-resi-rates">
            <div class="card-group">
                <div class="card shadow-sm col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">Cek Resi</h5>
                        <form action="" method="POST">
                            @csrf
                            <label>Nomor Resi</label>
                            <input type="text" name="nomor_resi" class="form-control " placeholder="Nomor Resi">
                            <button type="submit" class="btn btn-info btn-block mt-3">Lacak Resi</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Cek Tarif</h5>
                        <form action="{{ url('tarif') }}" method="GET">
                            @csrf
                            <div class="form-row align-items-center row">
                                <div class="col-md-5">
                                    <label>Origin</label>
                                    <select class="form-control single-select-field" name="origin">
                                        <option selected>Origin...</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == $origin ? 'selected' : '' }}>{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>Destination</label>
                                    <select class="form-control single-select-field" name="destination">
                                        <option selected>Destination...</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == $destination ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 my-3">
                                    <button type="submit" class="btn btn-warning btn-block">Cek Tarif</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>

        <div class="container">

            @if (!$result)
                <div class="alert alert-danger text-center">

                    Data Tidak di temukan, Ulangi Pencarian
                </div>
            @else
                <div class="row">

                    <div class="col-md-3">
                        <div class="history-tl-container">
                            <ul class="tl">
                                <li class="tl-item" ng-repeat="item in retailer_history">

                                    <div class="item-title">{{ $origin_name->name }}</div>
                                    <div class="item-detail">Origin</div>
                                </li>

                                <li class="tl-item" ng-repeat="item in retailer_history">

                                    <div class="item-title">{{ $destination_name->name }}</div>
                                    <div class="item-detail">Destination</div>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col">Kendaraan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehicles as $vehicle)
                                    <tr>
                                        <th scope="row"><img class="img-fluid" src="{{ $vehicle->image_url }}"> </th>
                                        <td>
                                            {{ $vehicle->name }}<br>
                                            P : {{ $vehicle->long }} cm,
                                            L : {{ $vehicle->wide }} cm,
                                            T : {{ $vehicle->height }} cm<br>
                                            Berat Maksimal : {{ $vehicle->weight }} Kg

                                        </td>
                                        <td>
                                            @php
                                                $total_price = $result->price + $vehicle->price;
                                            @endphp
                                            Rp. {{ number_format($total_price) }}

                                        </td>
                                        <td>
                                            <form action="{{ url('order') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="origin" value="{{ $origin_name->name }}">
                                                <input type="hidden" name="destination"
                                                    value="{{ $destination_name->name }}">
                                                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                                <input type="hidden" name="vehicle_name" value="{{ $vehicle->name }}">
                                                <input type="hidden" name="vehicle_price" value="{{ $vehicle->price }}">
                                                <input type="hidden" name="rate_price" value="{{ $result->price }}">

                                                <input type="hidden" name="total_price" value="{{ $total_price }}">

                                                <button class="btn btn-primary">Order</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    Data tidak di temukan
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Select 2 Bootstrap 5
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
