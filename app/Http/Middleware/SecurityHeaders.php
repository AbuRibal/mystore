<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // منع التصفح في iframe (حماية من Clickjacking)
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // منع المتصفح من تخمين نوع المحتوى
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // تفعيل حماية XSS في المتصفحات القديمة
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // سياسة الأمان للمحتوى (CSP) - مهم جداً
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; " .
            "style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; " .
            "img-src 'self' data: https://images.unsplash.com https://via.placeholder.com; " .
            "font-src 'self'; " .
            "connect-src 'self';"
        );
        
        // منع الكشف عن إصدار PHP
        $response->headers->remove('X-Powered-By');
        
        return $response;
    }
}