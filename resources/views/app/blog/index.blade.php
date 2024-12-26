@extends('app.layouts.master')
@section('title', 'Blogs')
{{--window title --}}


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

    <!--Blog Start-->
    <div class="blog-page pb_110">
        <div class="container">
            <div class="row pt_60">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach($blogs as $blog)
                            <div class="col-md-6">
                                @include('app.components.blog.blog_item')
                            </div>
                        @endforeach
                    </div>
                </div>
                @include('app.blog.sidebar')
            </div>
        </div>
    </div>
    <!--Blog End-->
@endsection