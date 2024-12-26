@extends("admin.layouts.master")
@section("title", "Profile")
@section("content")
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route("admin.dashboard") }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>

            {!! session("message") !!}

            <div class="section-body">
                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Jump To</h4>
                            </div>
                            <div class="card-body">
                                @include("admin.profile.nav")
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route("admin.profile") }}" method="POST" class="needs-validation"
                              id="setting-form" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
{{--                            <input type="hidden" name="_method" value="PUT">--}}
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="name"
                                               class="form-control-label col-sm-3 text-md-right">Full Name</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User Image</label>
                                        <div class="col-sm-6 col-md-9">
                                            <div id="image-preview" class="image-preview image-preview-custom float-lg-left"
                                                 style="background-image: url('{{ asset('storage/uploads/' . $user->image) }}'); background-size: cover; background-position: center center">
                                                <label for="image" id="image-label">Choose Image</label>
                                                <input type="file" name="image" id="image"
                                                       accept="image/*"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row align-items-center">
                                        <label for="email"
                                               class="form-control-label col-sm-3 text-md-right">Email Address</label>
                                        <div class="col-sm-6 col-md-9">
                                            <input type="text" class="form-control" value="{{ $user->email }}" id="email" name="email">
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


@push("js-libraries")
    <script src="{{ asset("assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js") }}"></script>
@endpush

@push('scripts')
    <script>
        // User Image
        jQuery.uploadPreview({
            input_field: "#image",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "Choose Image",
            label_selected: "Change Image",
            no_label: false,
            success_callback: null
        });
    </script>
@endpush