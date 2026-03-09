<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginAttempt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthenticatedSessionController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['destroy']),
            new Middleware('throttle:5,1', only: ['store']), // 5 محاولات كحد أقصى في الدقيقة
            new Middleware('security.headers'), // إضافة رؤوس الأمان
        ];
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // إضافة تأخير لمنع هجمات التخمين السريع
        sleep(1);
        
        // تسجيل محاولة الدخول
        $this->logLoginAttempt($request);
        
        // التحقق من عدد المحاولات الفاشلة من هذا الـ IP
        if ($this->isIpBlocked($request)) {
            Log::warning('محاولة دخول من IP محظور', [
                'ip' => $request->ip(),
                'email' => $request->email
            ]);
            
            return back()->withErrors([
                'email' => 'تم حظر هذا العنوان مؤقتاً بسبب كثرة المحاولات الفاشلة. الرجاء المحاولة بعد 15 دقيقة.',
            ])->onlyInput('email');
        }

        try {
            $request->authenticate();
            
            // تسجيل الدخول الناجح
            $this->logSuccessfulLogin($request);
            
            $request->session()->regenerate();
            
            // إعادة تعيين عدد المحاولات الفاشلة بعد النجاح
            $this->clearFailedAttempts($request);
            
            // تسجيل حدث الدخول الناجح
            Log::info('دخول ناجح', [
                'user_id' => Auth::id(),
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->intended(route('home', absolute: false));

        } catch (\Exception $e) {
            // تسجيل المحاولة الفاشلة
            $this->logFailedAttempt($request);
            
            Log::warning('محاولة دخول فاشلة', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        // تسجيل عملية تسجيل الخروج
        if ($user) {
            Log::info('تسجيل خروج', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip()
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * تسجيل محاولة الدخول
     */
    private function logLoginAttempt(Request $request): void
    {
        try {
            LoginAttempt::create([
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'success' => false, // سيتم تحديثها لاحقاً إذا نجحت
                'attempted_at' => now()
            ]);
        } catch (\Exception $e) {
            // إذا كان جدول login_attempts غير موجود، نكتفي بالتسجيل في اللوج
            Log::info('محاولة دخول', [
                'email' => $request->email,
                'ip' => $request->ip()
            ]);
        }
    }

    /**
     * تسجيل محاولة ناجحة
     */
    private function logSuccessfulLogin(Request $request): void
    {
        try {
            LoginAttempt::where('email', $request->email)
                ->where('ip', $request->ip())
                ->latest()
                ->first()
                ?->update(['success' => true]);
        } catch (\Exception $e) {
            // تجاهل الأخطاء
        }
    }

    /**
     * تسجيل محاولة فاشلة
     */
    private function logFailedAttempt(Request $request): void
    {
        // زيادة عداد المحاولات الفاشلة في الكاش
        $key = 'failed_logins_' . $request->ip();
        $attempts = cache($key, 0) + 1;
        cache([$key => $attempts], now()->addMinutes(15)); // تخزين لمدة 15 دقيقة
        
        Log::warning('فشل تسجيل الدخول', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'attempts' => $attempts
        ]);
    }

    /**
     * التحقق إذا كان الـ IP محظوراً
     */
    private function isIpBlocked(Request $request): bool
    {
        $key = 'failed_logins_' . $request->ip();
        $attempts = cache($key, 0);
        
        // حظر الـ IP إذا تعدى 10 محاولات فاشلة
        return $attempts >= 10;
    }

    /**
     * إعادة تعيين المحاولات الفاشلة بعد النجاح
     */
    private function clearFailedAttempts(Request $request): void
    {
        $key = 'failed_logins_' . $request->ip();
        cache()->forget($key);
    }
}