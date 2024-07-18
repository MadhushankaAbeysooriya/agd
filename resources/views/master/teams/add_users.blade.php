@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Group</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Group Management</li>
                  <li class="breadcrumb-item active">Add User</li>
                </ol>
            </div>
          </div>
    </section>
  </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-cyan">
                        <div class="card-header">
                            <h3 class="card-title">Add Users for {{$group->name}}</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('groups.add_user_store',$group->id)}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="users">Users</label>
                                    <div class="col-sm-6 select2-purple">
                                        <select name="users[]" id="users" class="multiple form-control" multiple>
                                            @foreach($users as $item)
                                                <option value="{{ $item->id }}" @if(in_array($item->name, $user_group)) selected @endif>
                                                    {{ $item->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('students')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="groups">Groups</label>
                                    <div class="col-sm-6 select2-purple">
                                        <select name="groups[]" id="groups" class="multiple form-control" multiple>
                                            @foreach($groups as $item)
                                                <option value="{{ $item->id }}" @if(in_array($item->name, $group_group)) selected @endif>
                                                    {{ $item->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('users')
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
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
@endsection

@section('third_party_scripts')
    {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}" ></script> --}}
    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            $('.multiple').select2();
        });
    </script>
@endsection
