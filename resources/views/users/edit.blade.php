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
                  <li class="breadcrumb-item active">Update</li>
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
                            <h3 class="card-title">Update User</h3>
                        </div>

                        <form role="form" action="{{ route('users.update',$user->id) }}" method="post"
                              enctype="multipart/form-data">
                              @csrf
                              @method('PUT')

                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('username')
                                        is-invalid @enderror" name="username" value="{{ $user->username }}" id="username" autocomplete="off" disabled>
                                        <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('fname')
                                        is-invalid @enderror" name="fname" value="{{ $user->fname }}" id="fname" autocomplete="off">
                                        <span class="text-danger">@error('fname') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('lname')
                                        is-invalid @enderror" name="lname" value="{{ $user->lname }}" id="lname" autocomplete="off">
                                        <span class="text-danger">@error('lname') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('email')
                                        is-invalid @enderror" name="email" value="{{ $user->email }}" id="email" autocomplete="off">
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('mobile')
                                        is-invalid @enderror" name="mobile" value="{{ $user->mobile }}" id="mobile" autocomplete="off">
                                        <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nic" class="col-sm-2 col-form-label">NIC</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('nic')
                                        is-invalid @enderror" name="nic" value="{{ $user->nic }}" id="nic" autocomplete="off">
                                        <span class="text-danger">@error('nic') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2" for="roles">Role</label>
                                    <div class="col-sm-6 select2-blue">
                                        <select required name="roles[]" id="roles"
                                                class="multiple form-control" >
                                            @foreach($roles as $roleValue => $roleName)
                                                <option value="{{ $roleValue }}" @if(in_array($roleValue, $userRole)) selected @endif>
                                                    {{ $roleName }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                </div>
                                <div class="card-footer">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-success" >Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
        </div>

        {{--  --}}

@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">

    <style>
        .select2-selection--single
        {
            height: 38px!important;
        }
    </style>

@endsection

@section('third_party_scripts')

    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>
    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>

    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

@endsection
