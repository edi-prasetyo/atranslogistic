@extends('layouts.admin')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">

            <div class="col-md-7">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    This page has been enhanced for printing. Click the print button at the bottom of the
                                    invoice to test.
                                </div>


                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-truck"></i> Rincian Pengiriman

                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-5 invoice-col">
                                            From
                                            <address>
                                                <strong>{{ $order->shipper_name }}</strong><br>
                                                {{ $order->shipper_address }}<br>
                                                {{ $order->city_origin }}<br>
                                                Phone: {{ $order->shipper_phone }}<br>

                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-5 invoice-col">
                                            To
                                            <address>
                                                <strong>{{ $order->recipient_name }}</strong><br>
                                                {{ $order->recipient_address }}<br>
                                                {{ $order->city_destination }}<br>
                                                Phone: {{ $order->recipient_phone }}<br>

                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-2 invoice-col">
                                            <img class="img-fluid" src="{{ url($order->qrcode) }}">
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Service</th>
                                                        <th>Kategori</th>
                                                        <th>Nomor Resi</th>

                                                        <th>Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $order->vehicle_name }}</td>
                                                        <td>{{ $order->category_name }}</td>
                                                        <td>{{ $order->receipt_number }}</td>

                                                        <td> <b>Rp. {{ number_format($order->total_price) }}</b> </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-8">
                                            <p class="lead">Note:</p>
                                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">

                                            </p>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">

                                        </div>

                                    </div>
                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print mt-5">
                                        <div class="col-12">
                                            {{-- <a href="invoice-print.html" rel="noopener" target="_blank"
                                                class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                            <button type="button" class="btn btn-success float-right"><i
                                                    class="far fa-credit-card"></i> Submit
                                                Payment
                                            </button> --}}
                                            <a href="" class="btn btn-primary float-right"
                                                style="margin-right: 5px;">
                                                <i class="fas fa-user"></i> Pilih Driver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>



            <div class="col-md-5">

                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        @foreach ($tracking as $tracking)
                            {{-- <div class="time-label">
                            <span class="bg-green">{{ $tracking->created_at }}</span>
                        </div> --}}

                            <!-- timeline item -->
                            <div>
                                <i class="fa fa-truck bg-success fs-6"></i>
                                <div class="timeline-item">

                                    <h3 class="timeline-header"><span class="time"><i class="fas fa-clock"></i>
                                            {{ date('d M Y', strtotime($tracking->created_at)) }} -
                                            {{ date('H:i:s', strtotime($tracking->created_at)) }}</span></h3>
                                    <div class="timeline-body">
                                        {{ $tracking->stage }}
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        @endforeach

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <!-- /.timeline -->

    </div>
@endsection
