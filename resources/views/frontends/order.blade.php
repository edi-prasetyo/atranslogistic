@extends('layouts.front')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="col-md-10 mx-auto">

            <div class="row">
                <div class="col-md-4">
                    <div class="history-tl-container">
                        <ul class="tl">
                            <li class="tl-item" ng-repeat="item in retailer_history">
                                <div class="item-title">{{ $origin }}</div>
                                <div class="item-detail">Origin</div>
                            </li>
                            <li class="tl-item" ng-repeat="item in retailer_history">

                                <div class="item-title">{{ $destination }}</div>
                                <div class="item-detail">Destination</div>
                            </li>
                        </ul>
                    </div>

                    <div class="badge text-bg-primary"> {{ $vehicle_name }} </div>
                    Total Harga <h4> IDR.
                        {{ number_format($total_price) }} </h4>
                </div>
                <div class="col-md-8">


                    <form action="{{ url('order/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="city_origin" value="{{ $origin }}">
                        <input type="hidden" name="city_destination" value="{{ $destination }}">
                        <input type="hidden" name="vehicle_name" value="{{ $vehicle_name }}">
                        <input type="hidden" name="price" value="{{ $total_price }}">
                        <input type="hidden" name="total_price" value="{{ $total_price }}">

                        <div class="card">
                            <div class="card-header bg-body">
                                <h4> <i class="bi bi-geo"></i> Data Pengirim </h4>
                            </div>
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Pengirim</label>
                                            <input type="text" class="form-control" name="shipper_name"
                                                placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nomor Hp Pengirim</label>
                                            <input type="text" class="form-control" name="shipper_phone"
                                                placeholder="Nomor Hp">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Alamat Pickup</label>
                                            <textarea class="form-control" name="shipper_address" placeholder="Alamat Pengambilan"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header bg-body">
                                <h4> <i class="bi bi-geo-alt"></i> Data Penerima </h4>
                            </div>
                            <div class="card-body">

                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Penerima</label>
                                            <input type="text" class="form-control" name="recipient_name"
                                                placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nomor Hp Penerima</label>
                                            <input type="text" class="form-control" name="recipient_phone"
                                                placeholder="Nomor Hp">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Alamat Penerima</label>
                                            <textarea class="form-control" name="recipient_address" placeholder="Alamat Penerima"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                Data Barang
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Kategori Barang</label>
                                            <select
                                                class="form-control select2 @error('category_name') is-invalid @enderror"
                                                name="category_name" style="width: 100%;">
                                                <option value="">--Pilih Kategori--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Barang</label>
                                            <input type="text" class="form-control" name="item_name"
                                                placeholder="Nama Barang">
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-truck"></i>
                                    Request
                                    Order</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
