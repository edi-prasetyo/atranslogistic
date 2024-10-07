@extends('layouts.admin')


@section('content')
    <div class="">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        {{-- Default --}}
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Role Management
                        <div class="float-end">
                            @can('role-create')
                                <a class="btn btn-success" href="{{ url('roles/create') }}"> Create New Role</a>
                            @endcan
                        </div>
                    </h2>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Striped Full Width Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ url('roles/delete', $role->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm" href="{{ url('roles/show', $role->id) }}">Show</a>
                                    @can('role-update')
                                        <a class="btn btn-primary btn-sm" href="{{ url('roles/edit', $role->id) }}">Edit</a>
                                    @endcan


                                    @csrf
                                    @method('DELETE')
                                    @can('role-delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        {!! $roles->render() !!}

    </div>
@endsection
