@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kendaraan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kendaraan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">

            <h4> Kendaraan</h4>
            @can('vehicle-create')
                <div class="card-tools float-right">
                    <a class="btn btn-success float-right" href="{{ url('vehicles/create') }}"> Create New </a>
                </div>
            @endcan


        </div>
        <table class="table table-striped">
            <tr>

                <th width="5%">Image</th>
                <th>Jenis</th>
                <th>P</th>
                <th>L</th>
                <th>T</th>
                <th>Volume</th>
                <th>Kapasitas</th>
                <th>Harga</th>
                <th width="20%">Action</th>
            </tr>
            @foreach ($vehicles as $data)
                <tr>
                    <td><img src="{{ $data->image_url }}" class="img-fluid"> </td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->long }} cm</td>
                    <td>{{ $data->wide }} cm </td>
                    <td>{{ $data->height }} cm </td>
                    <td>{{ $data->volume }} m3 </td>
                    <td>{{ $data->weight }} KG</td>

                    <td>Rp. {{ number_format($data->price) }}</td>

                    <td>
                        <form action="{{ url('vehicles/delete', $data->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ url('page', $data->slug) }}">View</a>
                            @can('vehicle-update')
                                <a class="btn btn-primary btn-sm" href="{{ url('vehicles/edit', $data->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('vehicle-delete')
                                <button type="submit" data-confirm-delete="true" class="btn btn-danger btn-sm">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
@endsection
