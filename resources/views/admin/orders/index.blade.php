@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order Pe</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Provinsi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">

        <div class="card">
            <table class="table table-striped ">
                <tr>
                    <th>#</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Kendaraan</th>
                    <th>No Resi</th>
                    <th width="10">Status</th>
                    <th width="5%">QR</th>
                    <th width="15%">Action</th>
                </tr>
                @foreach ($orders as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><b> {{ $data->shipper_name }} </b><br>
                            {{ $data->city_origin }}<br>
                        </td>
                        <td> <b> {{ $data->recipient_name }} </b> <br>
                            {{ $data->city_destination }}<br>
                        </td>
                        <td>{{ $data->vehicle_name }}<br>

                            Rp. {{ number_format($data->total_price) }}
                        </td>
                        <td><b> {{ $data->receipt_number }}</b> </td>
                        <td>
                            @if ($data->status == 0)
                                <small class="badge badge-danger">Belum di Pickup</small>
                            @elseif($data->status == 1)
                                <small class="badge badge-primary">Sedang Di Kirim</small>
                            @else
                                <small class="badge badge-success">Selesai</small>
                            @endif
                        </td>
                        <td><img class="img-fluid" src="{{ url($data->qrcode) }}"> </td>
                        <td>
                            <a href="{{ url('/') }}" class="btn btn-success">Lacak</a>
                            <a href="{{ url('orders/show/' . $data->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
