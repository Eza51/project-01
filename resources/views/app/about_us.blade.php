@extends('app.layouts.master')
@section('title', 'About Us')

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
    @include('app.components.banner', ['title' => 'About Us'])
    <!--Banner End-->

    <!--About Start-->
    <div class="about-area pb_110">
        <div class="container">
            <div class="row pt_80">
                <div class="col-lg-12">
                    <div class="company-info mt_30">
                        <h2>{{ CoreHelper::getSetting('SETTING_ABOUT_US_PAGE_TITLE') }}</h2>
                        <div class="company-text">
                            {!! CoreHelper::getSetting('SETTING_ABOUT_US_PAGE_DETAIL') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--About End-->

@endsection