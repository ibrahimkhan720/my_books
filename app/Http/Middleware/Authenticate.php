<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {

            // اگر request admin prefix والی ہے
            if ($request->is('admin/*')) {
                return route('admin.login');  // admin login route کا نام
            }

            // باقی سب کے لیے frontend user login
            return route('user.login');  // user login route کا نام
        }
    }
}
