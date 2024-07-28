@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Court</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Court Management</li>
                  <li class="breadcrumb-item active">View</li>
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
                    <h3 class="card-title">View Court</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('courts.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Name:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Court Category:</strong>
                        </label>
                        <div class="col-sm-10">
                            @if(!empty($court->courtcategories))
                                @foreach($court->courtcategories as $v)
                                    <label class="badge badge-success mr-1">{{ $v->name }}</label>
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
