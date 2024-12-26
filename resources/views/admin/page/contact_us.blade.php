@extends('admin.layouts.master')
@section('title', 'Contact Us')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Contact Us</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Contact Us</div>
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
                        <form action="{{ route("admin.pages.contact_us") }}" method="POST" class="needs-validation"
                              id="setting-form" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>Contact Us</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="SETTING_CONTACT_PAGE_PHONE"
                                               class="form-control-label col-sm-3 text-md-right">Phone Number</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" name="SETTING_CONTACT_PAGE_PHONE"
                                                   value="{{ $settings["SETTING_CONTACT_PAGE_PHONE"] }}" class="form-control"
                                                   id="SETTING_CONTACT_PAGE_PHONE" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="SETTING_CONTACT_PAGE_EMAIL"
                                               class="form-control-label col-sm-3 text-md-right">Email Address</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" name="SETTING_CONTACT_PAGE_EMAIL"
                                                   value="{{ $settings["SETTING_CONTACT_PAGE_EMAIL"] }}" class="form-control"
                                                   id="SETTING_CONTACT_PAGE_EMAIL" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="SETTING_CONTACT_PAGE_ADDRESS"
                                               class="form-control-label col-sm-3 text-md-right">Address</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" name="SETTING_CONTACT_PAGE_ADDRESS"
                                                   value="{{ $settings["SETTING_CONTACT_PAGE_ADDRESS"] }}" class="form-control"
                                                   id="SETTING_CONTACT_PAGE_ADDRESS" autofocus>
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
