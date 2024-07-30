@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Case</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Case Management</li>
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
                    <h3 class="card-title">View Case</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('court_cases.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Case No:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->case_no }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Case File No:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->case_file_no }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Title:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->title }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Client Name:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->client_name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Start Date:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->started_date }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Case Category:</strong>
                        </label>
                        <div class="col-sm-10">
                            @if(!empty($court_case->casecategories))
                                @foreach($court_case->casecategories as $v)
                                    <label class="badge badge-success mr-1">{{ $v->name }}</label>
                                @endforeach
                            @else
                                <label class="badge badge-danger mr-1">N/A</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Court:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $court_case->court_id ? $court_case->court->name : 'N/A' }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Assignee:</strong>
                        </label>
                        <div class="col-sm-10">
                            @if($court_case->users && $court_case->users->isNotEmpty())
                                @foreach($court_case->users as $v)
                                    <label class="badge badge-success mr-1">{{ $v->fname }}</label>
                                @endforeach
                            @else
                                <label class="badge badge-danger mr-1">N/A</label>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
