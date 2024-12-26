@extends('app.layouts.master')
@section('title', 'Jobs | ' . $category->name)

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
    <div class="banner-area flex" style="background-image:url('{{ asset('app/img/slider-1.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ $category->name }}</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('job_category.index') }}">Category</a></li>
                            <li><span>{{ $category->name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Banner End-->

    <!--Job Page Start-->
    <div class="job-page review-selectbox mt_40">
        <div class="container">
            @if (!$jobs->count())
                <h1 class="text-center mt-4">Jobs Not Found</h1>
            @endif

            <div class="row">
                @foreach($jobs as $job)
                    @include('app.components.job.job_item')
                @endforeach
            </div>
            <!--Review-Pagination Start-->
            <div class="review-pagination mt_50 mb_50">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <div class="rev-pag-item">
                            @if ($jobs->previousPageUrl())
                                <a href="{{ $jobs->previousPageUrl() }}">Previous</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="rev-pag-number">
                            <ul>
                                @foreach(range(1, $jobs->lastPage()) as $page)
                                    @if ($jobs->currentPage() === $page)
                                        <li class="active">{{ $page }}</li>
                                    @else
                                        <li>
                                            <a href="{{ $jobs->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="rev-pag-item right">
                            @if ($jobs->nextPageUrl())
                                <a href="{{ $jobs->nextPageUrl() }}">Next</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--Review-Pagination End-->
        </div>
    </div>
    <!--Job Page End-->

@endsection

@push('scripts')
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
@endpush