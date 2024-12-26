@php use App\Helpers\CoreHelper; @endphp
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route("admin.pages.contact_us") }}"
           class="nav-link {{ CoreHelper::menuActive('admin.pages.contact_us') }}">Contact Us</a>
    </li>
    <li class="nav-item">
        <a href="{{ route("admin.pages.about_us") }}"
           class="nav-link {{ CoreHelper::menuActive('admin.pages.about_us') }}">About Us</a>
    </li>
</ul>
