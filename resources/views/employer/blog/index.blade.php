@extends('employer.layouts.master')
@section('title', 'Blogs')
@section("content")
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blogs</h1>
                <div class="section-header-button">
                    <a href="{{ route('employer.blogs.create') }}" class="btn btn-primary">Create New</a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route("employer.dashboard") }}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Blogs</div>
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
