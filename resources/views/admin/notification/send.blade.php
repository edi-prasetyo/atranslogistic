@extends('layouts.app')


@section('content')

    <div class="container">

        <div class="col-md-9 mx-auto">
            <h2 class="my-5">Add New Post</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ url('send/notification') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group mb-3">

                                <select class="form-select single-select-field @error('category_id') is-invalid @enderror"
                                    id="category-dropdown" name="fcm_token">
                                    <option value="">--Pilih User--</option>
                                    @foreach ($users as $key => $user)
                                        <option value="{{ $user->fcm_token }}">
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">

                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>

                        </div>

                    </div>

                    <div class="form-group my-3">
                        <textarea class="form-control" name="body" placeholder="Message Body"></textarea>
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary my-3">Send</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

@endsection
