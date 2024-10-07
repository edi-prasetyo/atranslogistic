@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Kendaraan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kendaraan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add new</h3>
            </div>
            <div class="card-body">


                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}


                <form action="{{ url('vehicles/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Jenis Kendaraan</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Harga</label>
                                <input type="text" name="price"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label>Panjang</label>
                                <input type="text" name="long"
                                    class="form-control @error('long') is-invalid @enderror" placeholder="Panjang">
                                @error('long')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label>Tinggi</label>
                                <input type="text" name="height"
                                    class="form-control @error('height') is-invalid @enderror" placeholder="Tinggi">
                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label>Lebar</label>
                                <input type="text" name="wide"
                                    class="form-control @error('wide') is-invalid @enderror" placeholder="Lebar">
                                @error('wide')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label>Volume () m3</label>
                                <input type="text" name="volume"
                                    class="form-control @error('volume') is-invalid @enderror" placeholder="Lebar">
                                @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">
                                <label>Kapasitas (Kg)</label>
                                <input type="text" name="weight"
                                    class="form-control @error('weight') is-invalid @enderror" placeholder="Kapasitas">
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="exampleInputFile">Keterangan</label>
                            <div class="form-group my-3">
                                <textarea class="form-control" name="description" placeholder="Keterangan"></textarea>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="form-group my-3">
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary my-3">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
