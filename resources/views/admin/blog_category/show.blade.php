@extends('admin.layouts.master')
@section('title', 'Blog Category Show')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog Category Show</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i>
                        View All</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.blog-categories.index') }}">Blog Categories</a>
                    </div>
                    <div class="breadcrumb-item active">Blog Category Edit</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST"
                              enctype="multipart/form-data"
                              class="needs-validation" novalidate="">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label text-right">Name *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name"
                                           value="{{ old('name', $blogCategory->name) }}" name="name" disabled>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-form-label text-md-right col-md-3">Status</label>
                                <div class="col-sm-12 col-md-6">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="status"
                                               value="1" id="status"
                                               class="custom-switch-input"
                                               disabled
                                                {{ $blogCategory->status ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection