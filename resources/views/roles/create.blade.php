@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">System Management</li>
                            <li class="breadcrumb-item ">Role Management</li>
                            <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="card-title">Create New Role</h3>
                        {{-- <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div> --}}
                    </div>

                    <form role="form" method="POST" action="{{route('roles.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value="{{ old('name') }}" id="name"
                                           autocomplete="off">
                                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>
                            </div>


                            <div class="form-group row p-5">
                                <label class="col-form-label mb-4">Permissions</label>
                                <div class="row">

                                    <div class="col-md-12">
                                        <label class="mb-3 text-danger">User Management</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if((!strpos($value,'master')) )
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['master-','-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Master Data</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'master'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                    {{  ucwords(str_replace(['master-','-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach



                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Create</button>
                        </div>
                </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
