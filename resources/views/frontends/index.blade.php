@extends('layouts.front')
@section('content')
    <section class="boot-elemant-bg hero bg-body"
        style="background-color:darkblue;height: 450px;background-position:  60% 40%; background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9)), url({{ url('uploads/images/bg.webp') }});">
        <div class="container position-relative py-md-5 py-0">
            <div class="row">
                <div class="container" style="position: absolute;">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text-left text-white">
                                <h1><b>Jasa Pengiriman Paket di seluruh Indonesia.</b></h1>
                                <p>Temukan Agen Atrans Express di kota anda.</p>
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
        {{-- <svg class="hero-svg bg-body" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
            <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
        </svg> --}}
    </section>

    <section class="py-5 bg-body">
        <div class="container cek-resi">
            <div class="card-group">
                <div class="card shadow-sm col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">Cek Resi</h5>
                        <form action="{{ url('tracking') }}" method="POST">
                            @csrf
                            <label>Nomor Resi</label>
                            <input type="text" name="receipt_number" class="form-control " placeholder="Nomor Resi">
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
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>Destination</label>
                                    <select class="form-control single-select-field" name="destination">
                                        <option selected>Destination...</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
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
