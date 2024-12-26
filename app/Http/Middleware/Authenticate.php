<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**JSON (JavaScript Object Notation) 
     * Get the path the user should be redirected to when they are not authenticated.
     */
    //If the user is not authenticated, it redirects them to the login page, or returns a null response 
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.auth.index');
    }
}
