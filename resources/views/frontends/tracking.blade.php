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
                                <h1><b> Tracking Paket Pengiriman</b></h1>
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

    <div class="container my-5">
        <div class="col-md-6 mx-auto">

            <div class="card">
                <div class="card-body">


                    <div class="history-tl-container">
                        <ul class="tl">
                            @foreach ($trackings as $tracking)
                                <li class="tl-item" ng-repeat="item in retailer_history">
                                    <div class="item-title">{{ $tracking->stage }}</div>
                                    <div class="item-detail">{{ date('d M Y', strtotime($tracking->created_at)) }} -
                                        {{ date('H:i:s', strtotime($tracking->created_at)) }}</div>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
