{{-- ADMIN LOGIN PAGE --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin : : Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
<div class="container-fluid">
    <div class="row g-0 flex-fill vh-100">
        <div class="col-12 col-lg-6 col-xl-4 auth-left">
            <div class="d-flex flex-column justify-content-center align-items-center mx-4 h-100">
                <div>
                    <img src="{{ asset('storage/uploads/' . CoreHelper::getSetting('SETTING_SITE_LOGO')) }}" width="200" alt="">
                </div>

                <div class="mb-4 mt-2 text-center">
                    <h6 class="text-muted">Admin Login</h6>
                     {{-- session controller er error/success key er message dekhay --}}
                    <div class="text-danger">{{ session('error') }}</div>
                    <div class="text-success">{{ session('success') }}</div>
                </div>

                <div class="w-100">
                    <form action="{{ route('admin.auth.login') }}" method="post" class="auth-form">
                        @csrf
                        <div class="form-group">
                            <label class="d-block">
                                @error('email')
                                <div class="text-danger mb-1 text-right">{{ $message }}</div>
                                @enderror
                                <input type="email" placeholder="Enter your email address" name="email"
                                       value="{{ old('email') }}"
                                       class="form-control" autofocus>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="d-block">
                                {{-- validation error er jonno
                                function sendResetLinkEmail e validation --}}
                                @error('password')
                                <div class="text-danger mb-1 text-right">{{ $message }}</div>
                                @enderror
                                <input type="password" placeholder="Enter you password" name="password"
                                       class="form-control">
                            </label>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <div class="custom-control custom-checkbox">--}}
{{--                                <input type="checkbox" name="remember" class="custom-control-input" id="remember">--}}
{{--                                <label class="custom-control-label" for="remember">Remember Me</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <button class="btn btn-primary w-100 mt-4">Login</button>
                        </div>
                    </form>
{{-- forget password...route hit web.php admin.auth.forgot_password  --}}
                    <p class="text-center">
                        <a href="{{ route('admin.auth.forgot_password') }}" class="auth-link">Forgot your password</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="position-relative col-12 col-lg-6 col-xl-8 d-none d-lg-block auth-right"
             style="background-image: url('{{ asset(sprintf("storage/images/%s.jpg", rand(1, 5))) }}')">
            <div class="auth-copyright mb-2 mr-4">
                <h4>JobFinderBd</h4>
                <p>Copyright &copy; 2024 NowshinEza | Version 1.0</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>