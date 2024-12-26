@extends('app.layouts.master')
@section('title', 'Employer Detail | ' . $employer->name)

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
    <div class="banner-area flex"
         style="background-image:url('{{ asset('storage/uploads/accounts/' . $employer->cover_image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>{{ $employer->name }}</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><span>{{ $employer->name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->

    <!--Blog Start-->
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="">
                    <img class="mb-2" width="150px"
                         src="{{ asset('storage/uploads/accounts/' . $employer->avatar_image) }}" alt="">

                    <h4 class="font-weight-bold">{{ $employer->name }}</h4>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>Company Name</th>
                        <td>{{ $employer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $employer->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $employer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ $employer->address->country->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $employer->address->state->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $employer->address->city->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $employer->address->address ?? '' }}</td>
                    </tr>

                    <tr>
                        <th>Rating</th>
                        <td>{{ number_format($rating, 2) }}</td>
                        {{-- number format doshmik,,,last 2 00 --}}
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="business-area pb_90 pt-5 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="headline">
                                <h2>Jobs</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($jobs as $job)
                            @include('app.components.job.job_item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Blog End-->


@endsection