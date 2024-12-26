<!--Footer Start-->
<div class="footer-area pt_40 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <div class="logo">
                        <h1>
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('storage/uploads/' .  CoreHelper::getSetting('SETTING_SITE_LOGO')) }}"
                                     width="150"
                                     alt="">
                            </a>
                        </h1>
                    </div>
                    <p>{{ CoreHelper::getSetting('SETTING_SITE_DESCRIPTION') }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h3>Community</h3>
                    <ul>
                        <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                        <li><a href="{{ route('about_us') }}">About Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="footer-widget">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                        <li><a href="{{ route('job_category.index') }}">Job Categories</a></li>
                        <li><a href="{{ route('account.employer') }}">Employers</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <h3>Follow Us on</h3>
                    <div class="phn-email"><b>Phone</b><br> {!! CoreHelper::getSetting('SETTING_CONTACT_PAGE_PHONE') !!}</div>
                    <div class="phn-email mb_20"><b>Email</b><br> {!! CoreHelper::getSetting('SETTING_CONTACT_PAGE_EMAIL') !!}</div>

                    <span><a href="{{ CoreHelper::getSetting('SETTING_SOCIAL_FACEBOOK') }}"><i class="fa-brands fa-facebook"></i></a></span>
                    <span><a href="{{ CoreHelper::getSetting('SETTING_SOCIAL_YOUTUBE') }}"><i class="fa-brands fa-youtube"></i></a></span>
                    <span><a href="{{ CoreHelper::getSetting('SETTING_SOCIAL_INSTAGRAM') }}"><i class="fa-brands fa-instagram"></i></a></span>
                    <span><a href="{{ CoreHelper::getSetting('SETTING_SOCIAL_LINKEDIN') }}"><i class="fa-brands fa-linkedin"></i></a></span>
                    <span><a href="{{ CoreHelper::getSetting('SETTING_SOCIAL_TWITTER') }}"><i class="fa-brands fa-twitter"></i></a></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer-menu">
                    {{-- <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">User Guidelines</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer End-->

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>{!! CoreHelper::getSetting('SETTING_SITE_COPYRIGHT') !!}</p>
            </div>
        </div>
    </div>
</div>