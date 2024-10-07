@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Provinsi {{ $province->name }}</h1>
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



        @can('province-create')
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ url('cities/store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="province_id" value="{{ $province->id }}">

                        {{-- <div class="input-group input-group">
                            <input type="text" class="form-control form-control @error('name') is-invalid @enderror"
                                placeholder="Nama Kota">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Simpan</button>
                            </span>

                        </div> --}}


                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="form-label"> Name </label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kota">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label invisible"> Name </label>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        @endcan

        <div class="card">
            <table class="table table-striped ">
                <tr>
                    <th>Name</th>


                    <th width="15%">Action</th>
                </tr>
                @foreach ($cities as $key => $data)
                    <tr>
                        <td>{{ $data->name }}</td>

                        <td>
                            <form action="{{ url('provinces/delete', $data->id) }}" method="POST">
                                @can('province-update')
                                    <a class="btn btn-primary btn-sm" href="{{ url('provinces/edit', $data->id) }}">Edit</a>
                                @endcan
                                @csrf
                                @method('DELETE')
                                @can('province-delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>



    </div>
@endsection
