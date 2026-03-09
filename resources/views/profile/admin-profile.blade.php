<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- عنوان الصفحة -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">الملف الشخصي</h1>
                <p class="text-lg text-gray-600">مرحباً بعودتك، {{ Auth::user()->name }}</p>
            </div>

            <!-- بطاقات المعلومات -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- معلومات الملف الشخصي -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-l from-gray-50 to-white p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800">معلومات الملف الشخصي</h2>
                        <p class="text-sm text-gray-600 mt-1">قم بتحديث معلومات حسابك وعنوان البريد الإلكتروني</p>
                    </div>
                    
                    <div class="p-4 md:p-6">
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <!-- البريد الإلكتروني (غير قابل للتعديل) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                                <input type="email" 
                                    value="{{ Auth::user()->email }}" 
                                    class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600"
                                    readonly>
                                <p class="text-xs text-gray-500 mt-1">لا يمكن تغيير البريد الإلكتروني</p>
                            </div>
                            
                            <!-- الاسم -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                                <input type="text" 
                                    name="name" 
                                    value="{{ old('name', Auth::user()->name) }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- رسالة النجاح -->
                            @if(session('status') === 'profile-updated')
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>تم حفظ التغييرات بنجاح</span>
                            </div>
                            @endif
                            
                            <!-- زر الحفظ -->
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    حفظ التغييرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- تحديث كلمة المرور -->
                <!-- تحديث كلمة المرور -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-6">
    <div class="bg-gradient-to-l from-gray-50 to-white p-4 border-b">
        <h2 class="text-lg font-bold text-gray-800">تحديث كلمة المرور</h2>
        <p class="text-sm text-gray-600 mt-1">تأكد من استخدام كلمة مرور طويلة وعشوائية للحفاظ على الأمان</p>
    </div>
    
    <div class="p-4 md:p-6">
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')
            
            <!-- كلمة المرور الحالية -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الحالية</label>
                <input type="password" 
                       name="current_password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('current_password') border-red-500 @enderror"
                       required>
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- كلمة المرور الجديدة -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الجديدة</label>
                <input type="password" 
                       name="password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- تأكيد كلمة المرور -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور الجديدة</label>
                <input type="password" 
                       name="password_confirmation" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                       required>
            </div>
            
            <!-- رسالة نجاح تغيير كلمة المرور -->
            @if(session('status') === 'password-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>تم تحديث كلمة المرور بنجاح</span>
            </div>
            @endif
            
            <!-- زر التحديث -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    تحديث كلمة المرور
                </button>
            </div>
        </form>
    </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>