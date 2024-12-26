@extends('app.layouts.master')
@section('title', 'Set New Password')
{{-- Authcontroller function newpassword --}}
@section('content')
    @include('app.components.header')

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

    @include('app.components.banner', ['title' => 'Set New Password'])


    <div class="login-area bg-area pt_60 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    {!! session('message') !!}


                    <div class="login-form">
                        <form action="{{ route("new_password", $token) }}" method="post">
                            @csrf
                            <div class="form-row">
                                @csrf
                                @method("PUT")
                                {{-- http put method --}}
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" value="" class="form-control" id="password"
                                           autofocus>
                                           {{-- validation error er jonno
                                function e validation --}}
                                    @error('password')
                                    <div class="text-danger text-right">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" value="" class="form-control"
                                           id="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="text-danger text-right">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt_25">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="forgot-link">
                                    <a href="{{ route('login') }}">Login?</a>
                                </div>
                            </div>
                            <div class="col-md-6 align-right">
                                <div class="forgot-link">
                                    <a href="{{ route('register') }}">Don't have an account, sign up!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection