<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // تسجيل الـ aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'security.headers' => \App\Http\Middleware\SecurityHeaders::class,
        ]);

        // إضافة middleware للـ web group
        $middleware->appendToGroup('web', [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // تخصيص صفحة الخطأ 403
        $exceptions->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'غير مصرح لك بالدخول'], 403);
            }
            return redirect()->route('home')->with('error', 'غير مصرح لك بالدخول');
        });

        // تخصيص صفحة الخطأ 404
        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'الصفحة غير موجودة'], 404);
            }
            return response()->view('errors.404', [], 404);
        });

        // تخصيص صفحة الخطأ 500
        $exceptions->renderable(function (\Throwable $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'حدث خطأ في الخادم'], 500);
            }
            
            // تسجيل الخطأ في ملف اللوج
            \Illuminate\Support\Facades\Log::error('خطأ في النظام: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_id' => auth()->id(),
            ]);

            return response()->view('errors.500', [], 500);
        });
    })->create();