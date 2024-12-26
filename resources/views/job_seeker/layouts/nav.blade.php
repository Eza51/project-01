<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @php
                    use Illuminate\Support\Facades\Auth;
                    $user = Auth::guard('account')->user();
                    $avatar = $user->__get('avatar_image');
                    $avatarPath = 'storage/uploads/accounts/' . $avatar;
                    $avatarUrl = asset($avatarPath);
                @endphp

                <img alt="image"
                     src="{{ (!empty($avatar) && file_exists(public_path($avatarPath))) ? $avatarUrl : asset('assets/img/avatar/avatar-1.png') }}"
                     class="rounded-circle mr-1">

                <div class="d-sm-none d-lg-inline-block">{{ $user->__get('name') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title d-none">Logged in 5 min ago</div>
                <a href="{{ route('job_seeker.profile.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile Update
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('job_seeker.profile.logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
             
            </div>
        </li>
    </ul>
</nav>