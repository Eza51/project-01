@php use App\Helpers\CoreHelper; @endphp
@extends('admin.layouts.master')
@section('title', 'Blog Edit')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog Edit</h1>
                <div class="section-header-button">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i>
                        View All</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a>
                    </div>
                    <div class="breadcrumb-item active">Blog Edit</div>
                </div>
            </div>

            {!! session('message') !!}

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                              enctype="multipart/form-data"
                              class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="blog_category_id" class="col-sm-3 col-form-label text-right">Category
                                    *</label>
                                <div class="col-sm-6">
                                    <select name="blog_category_id" id="blog_category_id" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('blog_category_id', $blog->blog_category_id) == $category->id)>{{  $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">Title *</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="title"
                                           value="{{ old('title', $blog->title) }}" name="title" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-sm-3 col-form-label text-right">Slug</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="slug"
                                           value="{{ old('slug', $blog->slug) }}" name="slug">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="posted_on" class="col-sm-3 col-form-label text-right">Posted On</label>
                                <div class="col-sm-6">
                                    <input type="datetime-local" class="form-control" id="posted_on"
                                           value="{{ old('posted_on', $blog->posted_on) }}" name="posted_on">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="posted_by" class="col-sm-3 col-form-label text-right">Posted By</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="posted_by"
                                           value="{{ old('posted_by', $blog->posted_by) }}" name="posted_by">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-3 col-form-label text-right">Existing Image</label>
                                <div class="col-sm-6">
                                    @if (!empty($blog->image) && file_exists(public_path("storage/uploads/blogs/$blog->image")))
                                        {!! CoreHelper::image(asset("storage/uploads/blogs/$blog->image"), ['width' => '160px']) !!}
                                    @else
                                        {!! CoreHelper::image(asset('assets/img/example-image.jpg'), ['width' => '160px']) !!}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-3 col-form-label text-right">Image</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" id="image"
                                           value="{{ old('image') }}" name="image" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="short_description" class="col-sm-3 col-form-label text-right">Short
                                    Description *</label>
                                <div class="col-sm-6">
                                    <textarea name="short_description" id="short_description"
                                              class="form-control textarea-h-150">{{ old('short_description', $blog->short_description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label text-right">Description
                                    *</label>
                                <div class="col-sm-6">
                                    <textarea name="description" id="description"
                                              class="form-control summernote-simple">{{ old('description', $blog->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Publish" @selected(old('status', $blog->status) == 'Publish')>
                                            Publish
                                        </option>
                                        <option value="Pending" @selected(old('status', $blog->status) == 'Pending')>
                                            Pending
                                        </option>
                                        <option value="Unpublished" @selected(old('status', $blog->status) == 'Unpublished')>
                                            Unpublished
                                        </option>
                                    </select>
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush