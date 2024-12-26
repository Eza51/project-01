@extends('job_seeker.layouts.master')
@section('title', 'Applied Jobs')
@section("content")
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Applied Jobs</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route("job_seeker.dashboard") }}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Applied Jobs</div>
                </div>
            </div>

            {!! session('message') !!}
{{-- yajradatatable --}}
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>

            <form class="modal-part" id="modal-login-part">
                <p>This login form is taken from elements with <code>#modal-login-part</code> id.</p>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <input type="number" min="1" max="5" id="rating" class="form-control" name="rating">
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush