@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">System Management</li>
                            <li class="breadcrumb-item ">User Management</li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
        </section>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">View User</h3>
                        <div class="card-tools">
                            <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>Username:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->username }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>First Name:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->fname }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>Last Name:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->lname }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>Email:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>NIC:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->nic }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>Mobile:</strong>
                            </label>
                            <div class="col-sm-10">
                                {{ $user->mobile }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">
                                <strong>Roles:</strong>
                            </label>
                            <div class="col-sm-10">
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
