<?php

namespace App\Providers;

use App\Helpers\ConstantHelper;
use App\Models\Blog;
use App\Models\JobPost;
use App\Policies\Employer\JobPolicy AS EmployerJobPolicy;
use App\Policies\Employer\BlogPolicy AS EmployerBlogPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
//cnfig e app.php te settingSERVICEPROVIDER ADD korsi

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    //2 ta policy authserviceprovider e register kora ase
    protected $policies = [
        JobPost::class => EmployerJobPolicy::class,//JobPolicy alice kora
        Blog::class => EmployerBlogPolicy::class,//BlogPolict alice kors
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('employer.blogs', function () {//emplyers.blogs//blog controller e call 
            $account = Auth::guard('account')->user();// Get the currently logged-in user
            $plugins = explode(',', $account->__get('plugins'));//account tble plugin ase kina
//explod age onek gulaplugin chilo
            $BLOG_PLUGIN = ConstantHelper::PLUGINS[0]; // 0 index is 'Blog' Plugin

            return in_array($BLOG_PLUGIN, $plugins);
        });
    }
}
