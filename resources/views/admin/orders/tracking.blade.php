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
                                <span class="time"><i class="fas fa-clock"></i>
                                    {{ date('d M Y', strtotime($tracking->created_at)) }}</span>
                                <h3 class="timeline-header"></h3>
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
            <!-- /.col -->
        </div>

        <!-- /.timeline -->

    </div>
@endsection
