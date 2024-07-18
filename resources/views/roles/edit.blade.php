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
                        <h3 class="card-title">Update Role</h3>
                        {{-- <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div> --}}
                    </div>

                    <form role="form" action="{{ route('roles.update',$role->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $role->name }}" id="name"
                                           autocomplete="off">
                                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group row p-5">
                                <label class="col-form-label mb-4">Permission</label>
                                <div class="row">

                                    <div class="col-md-12">
                                        <label class="mb-3 text-danger">User Management</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if((!strpos($value,'master')) && (!strpos($value,'annual-demand')) && (!strpos($value,'demand-from-location')) && (!strpos($value,'receipt-from-location')) && (!strpos($value,'requisition-books')) && (!strpos($value,'issue-vouchers')) && (!strpos($value,'reports')) && (!strpos($value,'condemn-certs')) && (!strpos($value,'demand-from-customers')) && (!strpos($value,'customer-issuances')) && (!strpos($value,'customer-received')) && (!strpos($value,'export')))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
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
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
{{--                                                    {{ ucfirst(str_replace(['master-','-'], " ",$value->name)) }}</label>--}}
                                                    {{ucwords(str_replace(['master-', '-'], " ", $value->name)) }}</label>

                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Annual Demand</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'annual-demand'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Demand from Locations</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'demand-from-location'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Receipt from Locations</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'receipt-from-location'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Requisition Books</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'requisition-books'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Issue Vouchers</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'issue-vouchers'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Condemination Certificate</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'condemn-certs'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Demand from Customers</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'demand-from-customers'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Customer Issuances</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'customer-issuances'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Customer Received</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'customer-received'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Export</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'export'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        <label class="mt-3 mb-3 text-danger">Reports</label>
                                    </div>
                                    @foreach($permission as $value)
                                        @if(strpos($value,'reports'))
                                            <div class="col-md-4">
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ ucwords(str_replace(['-'], " ",$value->name)) }}</label>
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
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
