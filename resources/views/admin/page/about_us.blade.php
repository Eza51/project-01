@extends('admin.layouts.master')
@section('title', 'About Us')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>About Us</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">About Us</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Jump To</h4>
                            </div>
                            <div class="card-body">
                                @include("admin.page.nav")
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route("admin.pages.about_us") }}" method="POST" class="needs-validation"
                              id="setting-form" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>About Us</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="SETTING_ABOUT_US_PAGE_TITLE"
                                               class="form-control-label col-sm-3 text-md-right">Title</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" name="SETTING_ABOUT_US_PAGE_TITLE"
                                                   value="{{ $settings["SETTING_ABOUT_US_PAGE_TITLE"] }}"
                                                   class="form-control"
                                                   id="SETTING_ABOUT_US_PAGE_TITLE" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="SETTING_ABOUT_US_PAGE_DETAIL"
                                               class="form-control-label col-sm-3 text-md-right">Detail</label>
                                        <div class="col-sm-6 col-md-9">
                                            <textarea name="SETTING_ABOUT_US_PAGE_DETAIL"
                                                      class="form-control"
                                                      id="SETTING_ABOUT_US_PAGE_DETAIL">{{ $settings["SETTING_ABOUT_US_PAGE_DETAIL"] }}</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <button class="btn btn-primary" id="save-btn">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>

    <script>
        if(jQuery().summernote) {
            $("#SETTING_ABOUT_US_PAGE_DETAIL").summernote({
                dialogsInBody: true,
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'link']],
                    ['font', ['strikethrough']],
                    ['para', ['paragraph']]
                ]
            });
        }

    </script>
@endpush