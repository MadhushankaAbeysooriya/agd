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
                  <li class="breadcrumb-item ">Court Management</li>
                  <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Create New Court</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('courts.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('court_cases.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="case_no" class="col-sm-2 col-form-label">Case No</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('case_no')
                                        is-invalid @enderror" name="case_no" value="{{ old('case_no') }}" id="case_no" autocomplete="off">
                                        <span class="text-danger">@error('case_no') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="case_file_no" class="col-sm-2 col-form-label">Case File No</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('case_file_no')
                                        is-invalid @enderror" name="case_file_no" value="{{ old('case_file_no') }}" id="case_file_no" autocomplete="off">
                                        <span class="text-danger">@error('case_file_no') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('title')
                                        is-invalid @enderror" name="title" value="{{ old('title') }}" id="title" autocomplete="off">
                                        <span class="text-danger">@error('title') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client_name" class="col-sm-2 col-form-label">Client Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('client_name')
                                        is-invalid @enderror" name="client_name" value="{{ old('client_name') }}" id="client_name" autocomplete="off">
                                        <span class="text-danger">@error('client_name') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="started_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-6">
                                        <input type="datetime-local" class="form-control @error('started_date') is-invalid @enderror" name="started_date"
                                        value="{{ date('Y-m-d\TH:i') }}" id="started_date" autocomplete="off" min="{{ date('Y-m-d\TH:i') }}" max="3000-01-01T00:00">
                                        <span class="text-danger">@error('started_date') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="case_categories">Case Category</label>
                                    <div class="col-sm-6 select2-blue">
                                        <select required name="case_categories[]" id="case_categories" class="multiple form-control" multiple>
                                            @foreach($case_categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('case_categories')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="court_id">Court</label>
                                    <div class="col-sm-6 select2-blue">
                                        <select required name="court_id" id="court_id" class="multiple form-control">
                                            @foreach($courts as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('court_id')
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
                                        <button type="submit" class="btn btn-sm btn-success" >Create</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection


@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/admin/css/adminlte.css') }}">
@endsection

@section('third_party_scripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}" ></script>
    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            $('.multiple').select2();
        });
    </script>
@endsection
