@extends('admin.layouts.master')
@section('title', 'Job Category Edit')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Job Category Edit</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.job-categories.index') }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i>
                        View All</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.job-categories.index') }}">Job Categories</a>
                    </div>
                    <div class="breadcrumb-item active">Job Category Edit</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.job-categories.update', $jobCategory->id) }}" method="POST"
                              enctype="multipart/form-data"
                              class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label text-right">Name *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name"
                                           value="{{ old('name', $jobCategory->name) }}" name="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-sm-3 col-form-label text-right">Slug</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="slug"
                                           value="{{ old('slug', $jobCategory->slug) }}" name="slug">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="icon" class="col-sm-3 col-form-label text-right">Icon (Font Awesome) *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="icon"
                                           placeholder="fa fa-user"
                                           value="{{ old('icon', $jobCategory->icon) }}" name="icon">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-form-label text-md-right col-md-3">Status</label>
                                <div class="col-sm-12 col-md-6">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="status" value="1" id="status" class="custom-switch-input"
                                                {{ $jobCategory->status ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection