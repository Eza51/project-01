@extends('admin.layouts.master')
@section('title', 'Blog Categories')
@section("content")
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog Categories</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">Create New</a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Blog Categories</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
