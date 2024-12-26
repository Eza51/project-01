@php use App\Helpers\ConstantHelper;use Illuminate\Support\Carbon;use Illuminate\Support\Facades\Auth; @endphp
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
    <div class="banner-area flex" style="background-image:url('{{ asset('app/img/slider-1.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ $job->title }}</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                            <li><span>{{ $job->title }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->


    @if (session()->has('message'))
        <div class="container">
            <div class="row">
                <div class="col-12 my-5">
                    {!! session('message') !!}
                </div>
            </div>
        </div>
    @endif

    <!--Career Detail Start-->
    <div class="career-detail-area bg-area pt_40 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-8 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="Career-detail-text mt_30">
                        <div>
                            {!! $job->description !!}
                        </div>
                        <div class="career-sidebar-list-btn">
                            <ul>
                                @if($job->deadline <= Carbon::now())
                                    <li><a href="javascript:void(0);" class="disabled">Job Closed</a></li>
                                @else
                                    @if (in_array($job->id, $applies))
                                        <li><a href="javascript:void(0);" class="disabled applied">Already Applied</a>
                                        </li>
                                    @else
                                        <li>
                                            @if (Auth::guard('account')->user())
                                                <form action="{{ route('jobs.apply') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="redirect"
                                                           value="{{ request()->fullUrl() }}">
                                                    <input type="hidden" name="job_post_id" value="{{ $job->id }}">
                                                    <button type="submit">&nbsp;Apply Now!</button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" target="_blank">Apply Now!</a>
                                            @endif
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="job-detail-keyword">
                        <ul>
                            <li><i class="fa fa-tags"></i>Keywords: {{ $job->attributeOther->tags ?? '' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="career-sidebar mt_30">
                        <div class="career-sidebar-heading">
                            <h4>Job Overview</h4>
                        </div>
                        <div class="career-sidebar-img">
                            @if (!empty($job->account->avatar_image) && file_exists(public_path("storage/uploads/accounts/{$job->account->avatar_image}")))
                                <img src="{{ asset("storage/uploads/accounts/{$job->account->avatar_image}") }}"
                                     width="200"
                                     alt="">
                            @else
                                <img src="{{ asset('assets/img/example-image.jpg') }}"
                                     width="200"
                                     alt="">
                            @endif
                        </div>
                        <div class="career-sidebar-right-cont">
                            <div class="career-sidebar-right-cont-wrapper">
                                <h4>{{ $job->title }}</h4>
                                <p>{{ $job->account->name }}</p>
                            </div>
                        </div>
                        <div class="career-sidebar-btn-wrapper">
                            <div class="career-sidebar-btn">
                                <ul>
                                    <li>Category: {{ $job->category->name }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="career-sidebar-main-wrapper">
                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Vacancy:</li>
                                        <li>{{ $job->vacancy }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Deadline:</li>
                                        <li>{{ date('F d, Y', strtotime($job->deadline)) }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Salary Type:</li>
                                        @foreach($job->attributes as $attribute)
                                            @if ($attribute->attribute->type == 'Salary Type')
                                                <li><a href="javascript:void(0);">{{ $attribute->attribute->name }}</a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Salary:</li>
                                        <li>
                                            {{ number_format($job->salary->min_salary) . ($job->salary->min_salary ? ' - ' . number_format($job->salary->min_salary ): '') . ' ' . ConstantHelper::CURRENCY }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-code"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Experience:</li>
                                        @foreach($job->attributes as $attribute)
                                            @if ($attribute->attribute->type == 'Experience')
                                                <li><a href="javascript:void(0);">{{ $attribute->attribute->name }}</a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-hand-grab-o"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Job Role:</li>
                                        @foreach($job->attributes as $attribute)
                                            @if ($attribute->attribute->type == 'Job Role')
                                                <li><a href="javascript:void(0);">{{ $attribute->attribute->name }}</a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Education Degree:</li>
                                        @foreach($job->attributes as $attribute)
                                            @if ($attribute->attribute->type == 'Education')
                                                <li><a href="javascript:void(0);">{{ $attribute->attribute->name }}</a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="career-sidebar-wrapper2">
                                <div class="career-sidebar-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="career-sidebar-icon-con">
                                    <ul>
                                        <li>Location:</li>
                                        <li>
                                            {{ $job->location->city ? $job->location->city->name . ', ' : '' }}
                                            {{ $job->location->state ? $job->location->state->name . ', ' : '' }}
                                            {{ $job->location->country ? $job->location->country->name : '' }}<br>
                                            {{ $job->location->address ?? '' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Career Detail End-->
@endsection