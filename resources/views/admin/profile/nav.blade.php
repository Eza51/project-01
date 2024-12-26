@php use App\Helpers\CoreHelper; @endphp
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route("admin.profile") }}"
           class="nav-link {{ CoreHelper::menuActive('admin.profile') }}">Profile</a>
        <a href="{{ route("admin.profile.password") }}"
           class="nav-link {{ CoreHelper::menuActive('admin.profile.password') }}">Password Change</a>
    </li>
</ul>
