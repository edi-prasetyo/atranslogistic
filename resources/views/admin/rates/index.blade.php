@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Provinsi</h1>
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
    <div class="container">



        @can('category-create')
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ url('rates/store') }}" method="POST">
                        @csrf


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Origin</label>
                                    <select class="form-control select2 @error('origin') is-invalid @enderror" name="origin"
                                        style="width: 100%;">
                                        <option value="">--Kota--</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('origin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Destination</label>
                                    <select class="form-control select2 @error('destination') is-invalid @enderror"
                                        name="destination" style="width: 100%;">
                                        <option value="">--Kota--</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary my-3">Submit</button>
                    </form>
                </div>
            </div>
        @endcan

        <div class="card">
            <table class="table table-striped ">
                <tr>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th></th>

                    <th width="5%"></th>
                    <th width="5%">Action</th>
                </tr>
                @foreach ($rates as $key => $data)
                    <tr>
                        <td>{{ $data->origin }} {{ $data->fromOrigin }} </td>
                        <td> {{ $data->destination }} {{ $data->toDestination }} </td>
                        <td>{{ $data->price }}</td>
                        <td>

                            @can('province-update')
                                {{-- <a class="btn btn-primary btn-sm" href="{{ url('provinces/edit', $data->id) }}">Edit</a> --}}
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#modal-default{{ $data->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="modal-default{{ $data->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Province</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('provinces/update', $data->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="form-label"> Name </label>
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            value="{{ $data->name }}">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>

                                            </div>
                                            {{-- <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>

                                            </div> --}}
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endcan
                        </td>
                        <td>
                            <form action="{{ url('provinces/delete', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('province-delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-block">Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {!! $rates->render() !!}

    </div>
@endsection
