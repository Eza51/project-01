{{-- Home page --}}
{{-- Home controller --}}

{{-- Authenticated Users: Display avatar, name, and dashboard link.
Non-Authenticated Users: Display "Register" and "Sign In" links. --}}

@php use Illuminate\Support\Facades\Auth; @endphp
@extends('app.layouts.master')
@section('title', CoreHelper::getSetting('SETTING_SITE_TITLE'))

@section('content')
    <!-- Header-area Start make slider -->
    <!-- Background Slider Section -->
    <div id="header-area" style="position: relative; width: 100%; height: 70vh; background-size: cover; background-position: center; transition: background-image 1s ease-in-out; background-image: url('{{ asset('app/img/slider-1.jpg') }}');">
        <!--Menu-area Start-->
        <div id="strickymenu" class="menu-area" style="position: absolute; top: 0; width: 100%; z-index: 101;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="logo">
                            <h1>
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('storage/uploads/' . CoreHelper::getSetting('SETTING_SITE_LOGO')) }}" width="146" alt="">
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="main-menu">
                            {{-- NaV BAr Main Menu --}}
                            @include('app.components.menu')
                        </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="header-right" style="display: flex; justify-content: flex-end; align-items: center; z-index: 103;">
                            <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
                                {{-- authenticated usr section --}}
                {{-- auth Blade directive to check if a user is authenticated using the 'account' guard. --}}
                              
                                @auth('account')
                                    <li class="ml-5" style="margin-right: 10px;">
                                        @php
        //$user: Retrieves the authenticated user from the 'account' guard.
        //$avatar: Gets the avatar image filename from the user's data.
//$avatarPath: Constructs the path to the avatar image.
//$avatarUrl: Generates a full URL for the avatar image using the asset helper function.



                                            $user = Auth::guard('account')->user();
                                            $avatar = $user->__get('avatar_image');
                                            $avatarPath = 'storage/uploads/accounts/' . $avatar;
                                            $avatarUrl = asset($avatarPath);
                                        @endphp

                                        {{-- : Link to the user's dashboard, conditionally pointing to the employer 
                                        or job seeker dashboard based on the user's account type. --}}
                                        <a href="{{ $user->__get('account_type') == 'Employer' ? route('employer.dashboard') : route('job_seeker.dashboard') }}">

                                            {{-- Displays the user's avatar. If the avatar exists and is non-empty, 
                                            it uses the user's avatar URL; otherwise, it defaults to a placeholder image. --}}
                                            <img alt="image" src="{{ (!empty($avatar) && file_exists(public_path($avatarPath))) ? $avatarUrl : asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" width="35">
                                            {{ $user->__get('name') }}
                                        </a>
                                    </li>
                                    {{-- Non-Authenticated User Section --}}
                                @else
                                    <li class="register" style="margin-right: 10px; ">
                                        <a href="{{ route('register') }}" style="display: block; color: #333; font-weight: 600; background: #f5f5f5; padding: 8px 20px; border-radius: 50px;  ">Register</a>
                                    </li>
                                    <li class="sign" >
                                    <!-- margin-top: -8px; -->
                                        <a href="{{ route('login') }}" style="display: block; color: #333; font-weight: 600; background: #f5f5f5; padding: 8px 20px; border-radius: 50px; ">Sign In</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Menu-area End-->

        <!--Search Form Start-->
        <div class="search-form" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; z-index: 100;">
            <form action="{{ route('jobs.index') }}" method="get">
                <div class="container">
                    <div class="row plr-15">
                        <div class="col-5 col-md-6 plr-0">
                            <div class="search-bar">
                                <label class="d-block">
                                    <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Job Title, Keyword" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col-5 col-md-5 plr-0">
                            <div class="search-bar">
                                <label class="d-block">
                                    <input type="text" name="location" value="{{ request()->input('location') }}" placeholder="Location" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 plr-0">
                            <div class="search-button">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--Search Form End-->

        <!-- Slider Dots -->
        <div class="slider-dots">
            <span class="dot" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>
   

    <!--Company Start-->
    <div class="pop-servicearea pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="headline">
                        <h2>Best Employers</h2>
                        {{-- WEB>PHP route --}}
                        <a href="{{ route('account.employer') }}">See All Employers</a>
                    </div>
                </div>
            </div>
            {{-- CSS properties, such as overflow: hidden.
            top margin 30 --}}
            <div class="row ov_hidden mt_30">
                @foreach($topCompanies as $company)
                {{-- homecontroller top compnies --}}


                {{-- ekhan theke bujhte hoobe ai blade e company id passi na --}}
                    @include('app.components.company.company_item')
                    {{-- shob job dekhay --}}
                @endforeach
            </div>
        </div>
    </div>
    <!--Company End-->

    <!-- Popular-Business Start-->
    <div class="business-area bg-area pb_90 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="headline">
                        <h2>New & Top Jobs</h2>
                        <a href="{{ route('jobs.index') }}">See More Jobs</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($topJobs as $job)
                    @include('app.components.job.job_item')
                @endforeach
            </div>
        </div>
    </div>
    <!-- Popular-Business End-->

     <!--Categories Start-->
    <div class="categorie-area pt_90 pb_90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="headline">
                        <h2>Top Categories</h2>
                        <a href="{{ route('job_category.index') }}">View all categories</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($topCategories as $category)
                    @include('app.components.job_category.category_item')
                @endforeach
            </div>
        </div>
    </div>
    <!--Categories End-->

    <!--Blog Start-->
    <div class="blog-area pt_90 pb_90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="headline">
                        <h2>Recent News</h2>
                        <a href="{{ route('blogs.index') }}">View all Post</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel owl-carousel">
                        @foreach($blogs as $blog)
                            @include('app.components.blog.blog_item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Blog End-->
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = [
            "{{ asset('app/img/slider-1.jpg') }}",
            "{{ asset('app/img/slider-2.jpg') }}",
            "{{ asset('app/img/slider-3.jpg') }}"
        ];
        let currentIndex = 0;
        const headerArea = document.getElementById('header-area');
        const dots = document.querySelectorAll('.dot');

        function changeBackgroundImage(index) {
            currentIndex = index;
            headerArea.style.backgroundImage = `url(${images[currentIndex]})`;
            updateDots();
        }

        function updateDots() {
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function currentSlide(index) {
            changeBackgroundImage(index);
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % images.length;
            changeBackgroundImage(currentIndex);
        }

        setInterval(nextSlide, 5000); // Change image every 5 seconds

        // Initial dot update
        updateDots();
    });
</script>

<style>
    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }

    .slider-dots .dot {
        display: inline-block;
        width: 15px;
        height: 15px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
    }

    .slider-dots .dot.active {
        background-color: #555;
    }
    /* Ensure the menu is always on top */
    #strickymenu {
        z-index: 102;
    }

    /* Ensure the header-right section is also on top */
    .header-right {
        z-index: 103;
    }
</style>