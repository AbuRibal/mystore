<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق من أن المستخدم مسجل دخول وهو أدمن
        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            return $next($request);
        }

        // إذا ليس أدمن، يرجع للصفحة الرئيسية
        return redirect('/')->with('error', 'غير مصرح لك بالدخول');
    }
}