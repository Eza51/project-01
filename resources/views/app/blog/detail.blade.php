@php use App\Helpers\CoreHelper; @endphp
@extends('app.layouts.master')
@section('title', 'Blogs')

@section('content')
    @include('app.components.header')

    <!--Header-Bar Start-->
    <div id="strickymenu" class="header-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-menu">
                        @include('app.components.menu')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Header-Bar End-->


    <!--Banner Start-->
    @include('app.components.banner', ['title' => 'Blogs'])
    <!--Banner End-->

    <div class="single-blog pb_110">
        <div class="container">
            <div class="row pt_80">
                <div class="col-lg-8 mt_30">
                    <div class="sin-blog-content">
                        {{-- $blog controller image collumn --}}
                        @if (!empty($blog->image) && file_exists(public_path("storage/uploads/blogs/$blog->image")))
                            <img src="{{ asset("storage/uploads/blogs/$blog->image") }}" alt="">
                        @else
                            <img src="{{ asset('assets/img/example-image.jpg') }}" alt="">
                        @endif
                        <h2>{{ $blog->title }}</h2>
                        {{-- $blog controller title column --}}
                        <ul>
                            <li><span><i class="fa fa-user"></i></span>{{ ucwords($blog->posted_by) }}</li>
                            <li><span><i class="fa fa-calendar"></i></span>{{ CoreHelper::timeAgo($blog->posted_on) }}</li>
                            <li><span><i class="fa fa-eye"></i></span>{{ CoreHelper::viewCount($blog->views) }}  Views</li>
                        </ul>
                        {{-- view constant helper e jasse...sekhane theke dekhasse --}}
{{-- ucwords is a PHP function used to capitalize the first letter --}}
                        {!! $blog->description !!}
                    </div>
                </div>
                @include('app.blog.sidebar')
            </div>
        </div>
    </div>
@endsection