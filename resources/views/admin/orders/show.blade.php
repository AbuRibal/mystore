<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>تفاصيل الطلب - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="w-full md:w-64 lg:w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white shadow-lg">
            <div class="p-4 md:p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl md:text-2xl font-bold flex items-center">
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        لوحة التحكم
                    </h2>
                    <button class="md:hidden text-white focus:outline-none" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-6 p-3 bg-gray-700 rounded-lg hidden md:block">
                    <p class="text-sm text-gray-300">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <nav id="mobileNav" class="hidden md:block px-4 pb-6 space-y-1">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center py-3 px-4 rounded-lg bg-blue-600 transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="font-medium">الطلبات</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 transition-colors">
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

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <!-- رأس الصفحة -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تفاصيل الطلب</h1>
                        <p class="text-gray-600 mt-1">رقم الطلب: <span class="font-bold text-blue-600">{{ $order->order_number }}</span></p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة للقائمة
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- بطاقات المعلومات -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- معلومات الطلب -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-l from-blue-50 to-white p-4 border-b">
                            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                معلومات الطلب
                            </h2>
                        </div>
                        <div class="p-4 space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">رقم الطلب:</span>
                                <span class="font-bold text-blue-600">{{ $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">تاريخ الطلب:</span>
                                <span class="font-medium">{{ $order->created_at->format('H:i d-m-Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">طريقة الدفع:</span>
                                <span class="font-medium">
                                    @switch($order->payment_method)
                                        @case('cash_on_delivery') 
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 ml-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                الدفع عند الاستلام
                                            </span>
                                        @break
                                        @case('ccp') CCP @break
                                        @case('baridi_mob') بريدي موب @break
                                        @default {{ $order->payment_method }}
                                    @endswitch
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">المجموع الكلي:</span>
                                <span class="text-xl font-bold text-green-600">{{ number_format($order->total) }} DA</span>
                            </div>
                        </div>
                    </div>

                    <!-- معلومات العميل -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-l from-green-50 to-white p-4 border-b">
                            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                معلومات العميل
                            </h2>
                        </div>
                        <div class="p-4 space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">الاسم:</span>
                                <span class="font-medium">{{ $order->customer_name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">الهاتف:</span>
                                <span class="font-medium flex items-center">
                                    <svg class="w-4 h-4 ml-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $order->customer_phone }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">البريد الإلكتروني:</span>
                                <span class="font-medium">{{ $order->customer_email ?? 'لا يوجد' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">العنوان:</span>
                                <span class="font-medium text-left">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- المنتجات -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="bg-gradient-to-l from-purple-50 to-white p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 ml-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            المنتجات
                        </h2>
                    </div>
                    
                    <!-- للشاشات الصغيرة (بطاقات) -->
                    <div class="block md:hidden p-4">
                        @foreach($order->items as $item)
                        <div class="bg-gray-50 p-3 rounded-lg mb-3">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-bold text-gray-800">{{ $item->product->name }}</span>
                                <span class="text-sm text-gray-600">{{ number_format($item->price) }} DA</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">الكمية: {{ $item->quantity }}</span>
                                <span class="font-bold text-green-600">المجموع: {{ number_format($item->price * $item->quantity) }} DA</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- للشاشات الكبيرة (جدول) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">المنتج</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">السعر</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">الكمية</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">المجموع</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $item->product->name }}</td>
                                    <td class="px-6 py-4">{{ number_format($item->price) }} DA</td>
                                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 font-bold text-green-600">{{ number_format($item->price * $item->quantity) }} DA</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 font-bold">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-left">الإجمالي الكلي:</td>
                                    <td class="px-6 py-4 text-green-600">{{ number_format($order->total) }} DA</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- تحديث حالة الطلب -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-l from-yellow-50 to-white p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 ml-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            تحديث حالة الطلب
                        </h2>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                            @csrf
                            @method('PUT')
                            <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>قيد المعالجة</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التوصيل</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                تحديث الحالة
                            </button>
                        </form>
                        
                        <!-- عرض الحالة الحالية -->
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">الحالة الحالية:</span>
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
                            <span class="px-3 py-1 mr-2 inline-block text-sm rounded-full {{ $color }}">
                                {{ $statusText[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('hidden');
        }
    </script>
</body>
</html>