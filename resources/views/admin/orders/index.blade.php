<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>إدارة الطلبات - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
        
        /* تحسينات للتابلت */
        @media (min-width: 640px) and (max-width: 1024px) {
            .tablet-card {
                background: white;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                border: 1px solid #f0f0f0;
            }
            
            .tablet-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            
            .sidebar-tablet {
                width: 200px !important;
            }
            
            .tablet-text {
                font-size: 14px;
            }
        }
        
        /* تحسينات للأجهزة اللوحية الكبيرة */
        @media (min-width: 768px) and (max-width: 1024px) {
            .container-tablet {
                padding: 24px !important;
            }
            
            .tablet-font-large {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar محسنة للتابلت -->
        <div class="w-full md:w-64 lg:w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white shadow-lg">
            <div class="p-4 md:p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl md:text-2xl font-bold flex items-center">
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        لوحة التحكم
                    </h2>
                    
                    <!-- زر القائمة للتابلت -->
                    <button class="md:hidden text-white focus:outline-none" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- معلومات المستخدم -->
                <div class="mt-6 p-3 bg-gray-700 rounded-lg hidden md:block">
                    <p class="text-sm text-gray-300">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <!-- روابط التنقل -->
            <nav id="mobileNav" class="hidden md:block px-4 pb-6 space-y-1">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center py-3 px-4 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="font-medium">الطلبات</span>
                    <span class="mr-auto bg-blue-500 text-xs px-2 py-1 rounded-full">{{ $orders->total() }}</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center py-3 px-4 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-medium">المنتجات</span>
                </a>
                
                <a href="{{ route('home') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">المتجر</span>
                </a>
            </nav>
        </div>

        <!-- Main Content - محسن للتابلت -->
        <div class="flex-1 p-4 md:p-6 lg:p-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- رأس الصفحة محسن للتابلت -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6">
                    <div class="mb-4 lg:mb-0">
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">الطلبات</h1>
                        <p class="text-gray-600 mt-1">إدارة ومتابعة جميع طلبات المتجر</p>
                    </div>
                    
                    <!-- إحصائيات سريعة - متجاوبة مع التابلت -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 w-full lg:w-auto">
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100">
                            <span class="text-xs text-gray-500">الكل</span>
                            <span class="block text-xl font-bold text-blue-600">{{ $orders->total() }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100">
                            <span class="text-xs text-gray-500">معلق</span>
                            <span class="block text-xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100">
                            <span class="text-xs text-gray-500">مكتمل</span>
                            <span class="block text-xl font-bold text-green-600">{{ $orders->where('status', 'delivered')->count() }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100">
                            <span class="text-xs text-gray-500">ملغي</span>
                            <span class="block text-xl font-bold text-red-600">{{ $orders->where('status', 'cancelled')->count() }}</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Grid مخصص للتابلت -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                    @foreach($orders as $order)
                    <!-- بطاقة طلب محسنة للتابلت -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden">
                        <!-- رأس البطاقة -->
                        <div class="bg-gradient-to-l from-gray-50 to-white p-4 border-b">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500 ml-2">رقم الطلب:</span>
                                    <span class="font-bold text-blue-600">#{{ $order->order_number }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $order->created_at->format('Y/m/d H:i') }}</span>
                            </div>
                        </div>
                        
                        <!-- محتوى البطاقة - شبكة 2 عمود للتابلت -->
                        <div class="p-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <!-- العميل -->
                                <div>
                                    <span class="text-xs text-gray-500 block">العميل</span>
                                    <span class="font-medium text-gray-800">{{ $order->customer_name }}</span>
                                </div>
                                
                                <!-- الهاتف -->
                                <div>
                                    <span class="text-xs text-gray-500 block">الهاتف</span>
                                    <span class="font-medium text-gray-800">{{ $order->customer_phone }}</span>
                                </div>
                                
                                <!-- الولاية -->
                                <div>
                                    <span class="text-xs text-gray-500 block">الولاية</span>
                                    <span class="font-medium text-gray-800">{{ $order->wilaya->name }}</span>
                                </div>
                                
                                <!-- المجموع -->
                                <div>
                                    <span class="text-xs text-gray-500 block">المجموع</span>
                                    <span class="font-bold text-green-600">{{ number_format($order->total) }} DA</span>
                                </div>
                            </div>
                            
                            <!-- السطر الثاني للتابلت -->
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                                <!-- الحالة -->
                                <div>
                                    <span class="text-xs text-gray-500 block">الحالة</span>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'shipped' => 'bg-purple-100 text-purple-800',
                                            'delivered' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800'
                                        ];
                                        $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                        $statusText = [
                                            'pending' => 'قيد الانتظار',
                                            'processing' => 'قيد المعالجة',
                                            'shipped' => 'تم الشحن',
                                            'delivered' => 'تم التوصيل',
                                            'cancelled' => 'ملغي'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 inline-block text-sm rounded-full {{ $color }}">
                                        {{ $statusText[$order->status] ?? $order->status }}
                                    </span>
                                </div>
                                
                                <!-- طريقة الدفع -->
                                <div>
                                    <span class="text-xs text-gray-500 block">طريقة الدفع</span>
                                    <span class="text-sm text-gray-700">
                                        @switch($order->payment_method)
                                            @case('cash_on_delivery') نقداً @break
                                            @case('ccp') CCP @break
                                            @case('baridi_mob') بريدي موب @break
                                            @default {{ $order->payment_method }}
                                        @endswitch
                                    </span>
                                </div>
                                
                                <!-- زر الإجراء -->
                                <div class="col-span-2 md:col-span-1 flex justify-end items-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors flex items-center">
                                        <span>عرض التفاصيل</span>
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- روابط التصفح - متجاوبة مع التابلت -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('hidden');
        }

        // تحسين تجربة اللمس للتابلت
        let touchstartX = 0;
        let touchendX = 0;
        
        document.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
        });
        
        document.addEventListener('touchend', e => {
            touchendX = e.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const nav = document.getElementById('mobileNav');
            if (touchendX < touchstartX - 50 && window.innerWidth < 768) {
                // سحب لليسار - فتح القائمة
                nav.classList.remove('hidden');
            }
            if (touchendX > touchstartX + 50 && window.innerWidth < 768) {
                // سحب لليمين - غلق القائمة
                nav.classList.add('hidden');
            }
        }
    </script>
</body>
</html>