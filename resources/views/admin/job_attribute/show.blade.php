@php use App\Helpers\ConstantHelper; @endphp
@extends('admin.layouts.master')
@section('title', 'Job Attribute Show')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Job Attribute Show</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.job-attributes.index') }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i>
                        View All</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.job-attributes.index') }}">Job Attributes</a>
                    </div>
                    <div class="breadcrumb-item active">Job Attribute Edit</div>
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
                                           value="{{ old('name', $jobAttribute->name) }}" name="name" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label text-right">Type *</label>
                                <div class="col-sm-6">
                                    <select name="type" id="type" class="form-control" disabled>
                                        <option value="">Choose...</option>
                                        @foreach(ConstantHelper::JOB_ATTRIBUTES_TYPE as $type)
                                            <option value="{{ $type }}" @selected(old('type', $jobAttribute->type))>{{ $type }}</option>
                                        @endforeach
                                    </select>
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
                                                {{ $jobAttribute->status ? 'checked' : '' }}>
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