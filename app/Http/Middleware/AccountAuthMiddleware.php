<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


//employers and jobseekers middle ware


class AccountAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    //handle user request handle kore
    //response e era url return kore
    
    public function handle(Request $request, Closure $next): Response
    {
     // Check if the user is not authenticated in the 'account' guard
        if (!Auth::guard('account')->check()) {
            return redirect()->route('login');
        }
//if authentocated
        $user = Auth::guard('account')->user();

        $accountType = $user->__get('account_type');
        // defines $directory as the sanitized route prefix without slashes
        $directory = str_replace('/', '', $request->route()->getAction('prefix'));//if route has prefix and slas it removes...but here it is not working
        // Accessing property directly, no need for __get

        $access = false; // Default access is false


        // access pabe if is an 'Employer' and if the route prefix ($directory) matches 'employer'.
        if ($accountType === 'Employer' && $directory === 'employer') {
            $access = true;
        }

        if ($accountType === 'Job Seeker' && $directory === 'job-seeker') {
            $access = true;
        }
// If access is still false, redirect to the login route
        if ($access === false) {
            return redirect()->route('login');
        }
 // Allow the request to proceed to the next middleware or controller
        return $next($request);
    }
}
