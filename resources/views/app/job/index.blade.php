@extends('app.layouts.master')
@section('title', 'Jobs')

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
    @include('app.components.banner', ['title' => 'Jobs'])
    <!--Banner End-->

    <!--Job Page Start-->
    <div class="job-page review-selectbox mt_40">
        <!--   Update Start-->
        <form action="{{ route('jobs.index') }}" method="get">

            @foreach(request()->all() as $name => $value)
                @continue($name == 'search' || $name == 'location')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach

            <div class="search-form pt_0 pb_0">
                <div class="container">
                    <div class="row plr-15">
                        <div class="col-4 col-md-5 plr-0">
                            <div class="search-bar">
                                <label class="d-block">
                                    <input type="text" name="search" value="{{ request()->input('search') }}"
                                           placeholder="Job Title, Keyword" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col-4 col-md-4 plr-0">
                            <div class="search-bar">
                                <label class="d-block">
                                    <input type="text" name="location" value="{{ request()->input('location') }}"
                                           placeholder="Location" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3 plr-0">
                            <div class="search-button">
                                {{-- <button onclick="openNav()" class="btn btn-default btn1" type="button"><i
                                            class="fa fa-filter"></i> Filter
                                </button> --}}
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search
                                </button>
                            </div>
                            {{-- @if (!empty(request()->all()))
                                <a href="{{ route('jobs.index') }}"
                                   class="text-right text-danger float-right mr-2"><small><i class="fa fa-trash"></i>
                                        Clear Filter</small></a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="mySidenav" class="sidenav">
            <form action="{{ route('jobs.index') }}" method="get">
                @foreach(request()->all() as $name => $value)
                    @if($name == 'search' || $name == 'location')
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="sidemenu">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <h2>Filter</h2>

                    <div class="sideitem">
                        <h3>Job Type</h3>
                        @foreach($jobAttributes as $attribute)
                            @continue($attribute->type !== 'Job Type')

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="{{ $attribute->name }}" type="radio"
                                           @checked($attribute->name == request()->input('job_type'))
                                           name="job_type"> {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="sideitem pt-2">
                        <h3>Salary Type</h3>
                        @foreach($jobAttributes as $attribute)
                            @continue($attribute->type !== 'Salary Type')

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="{{ $attribute->name }}" type="radio"
                                           @checked($attribute->name == request()->input('salary_type'))
                                           name="salary_type"> {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="sideitem pt-2">
                        <h3>Experience</h3>
                        @foreach($jobAttributes as $attribute)
                            @continue($attribute->type !== 'Experience')

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="{{ $attribute->name }}" type="radio"
                                           @checked($attribute->name == request()->input('experience'))
                                           name="experience"> {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="sideitem pt-2">
                        <h3>Job Role</h3>
                        @foreach($jobAttributes as $attribute)
                            @continue($attribute->type !== 'Job Role')

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="{{ $attribute->name }}" type="radio"
                                           @checked($attribute->name == request()->input('job_role'))
                                           name="job_role"> {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="sideitem pt-2">
                        <h3>Education</h3>
                        @foreach($jobAttributes as $attribute)
                            @continue($attribute->type !== 'Education')

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="{{ $attribute->name }}" type="radio"
                                           @checked($attribute->name == request()->input('education'))
                                           name="education"> {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="sideitem mt_15">
                        <h3>Category</h3>
                        <label class="d-block">
                            <select name="category" class="form-control">
                                <option value="">Choose...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}" @selected($category->name == request()->input('category'))>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="side-btn mt_20">
                        <button class="btn btn-default" type="submit">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <!--   Update End-->
        <div class="container">
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