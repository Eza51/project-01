<nav class="navbar navbar-expand-lg main-navbar">
      <!-- Left-aligned navigation toggle button -->
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <!-- Sidebar toggle button -->
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </div>
     <!-- Right-aligned navigation items -->
    <ul class="navbar-nav navbar-right">
        <!-- User dropdown menu -->
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @php
                // Import the Auth facade
                    use Illuminate\Support\Facades\Auth;
                    // Get the currently authenticated user
                    $user = Auth::guard('account')->user();
                     // Get the avatar image filename
                    $avatar = $user->__get('avatar_image');
                    // Build the path to the avatar image
                    $avatarPath = 'storage/uploads/accounts/' . $avatar;
                    // Generate the full URL to the avatar image
                    $avatarUrl = asset($avatarPath);
                @endphp
                
<!-- Display the user's avatar image, or a default image if the avatar doesn't exist -->
                <img alt="image"
                     src="{{ (!empty($avatar) && file_exists(public_path($avatarPath))) ? $avatarUrl : asset('assets/img/avatar/avatar-1.png') }}"
                     class="rounded-circle mr-1">
   <!-- Display the user's name -->
                <div class="d-sm-none d-lg-inline-block">{{ $user->__get('name') }}</div>
            </a>
            <!-- Dropdown menu -->
            <div class="dropdown-menu dropdown-menu-right">
                 <!-- Placeholder for login status -->
                <div class="dropdown-title d-none">Logged in 5 min ago</div>
                <!-- Link to the account update page -->
                <a href="{{ route('employer.account.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Account Update
                </a>
                 <!-- Divider -->
                <div class="dropdown-divider"></div>
                <a href="{{ route('employer.account.logout') }}" class="dropdown-item has-icon text-danger">
                   <!-- Logout link -->
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>