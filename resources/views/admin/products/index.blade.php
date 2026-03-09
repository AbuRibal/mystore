<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>إدارة المنتجات - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar (نفس تصميم الطلبات) -->
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
                <a href="{{ route('admin.orders.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="font-medium">الطلبات</span>
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

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- رأس الصفحة -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6">
                    <div class="mb-4 lg:mb-0">
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">المنتجات</h1>
                        <p class="text-gray-600 mt-1">إدارة جميع منتجات المتجر</p>
                    </div>
                    
                    <!-- زر إضافة منتج -->
                    <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة منتج جديد
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

                <!-- Grid المنتجات - متجاوب مع جميع الشاشات -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    @foreach($products as $product)
                    <!-- بطاقة المنتج -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden group">
                        <!-- صورة المنتج -->
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200?text='.urlencode($product->name) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            <!-- شارة السعر المخفض -->
                            @if($product->sale_price)
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                خصم {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                            </div>
                            @endif
                            
                            <!-- شارة الحالة -->
                            <div class="absolute top-2 left-2">
                                @if($product->is_active)
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">نشط</span>
                                @else
                                <span class="bg-gray-500 text-white text-xs px-2 py-1 rounded-full">غير نشط</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- محتوى البطاقة -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $product->name }}</h3>
                            
                            <!-- السعر -->
                            <div class="mb-3">
                                @if($product->sale_price)
                                <div class="flex items-center">
                                    <span class="text-xl font-bold text-red-600">{{ number_format($product->sale_price) }} DA</span>
                                    <span class="text-sm text-gray-400 line-through mr-2">{{ number_format($product->price) }} DA</span>
                                </div>
                                @else
                                <span class="text-xl font-bold text-blue-600">{{ number_format($product->price) }} DA</span>
                                @endif
                            </div>
                            
                            <!-- المتغيرات (الألوان/المقاسات) -->
                            @if($product->variants->count() > 0)
                            <div class="mb-3">
                                <span class="text-xs text-gray-500">المتغيرات: {{ $product->variants->count() }}</span>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($product->variants->take(3) as $variant)
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $variant->name }}</span>
                                    @endforeach
                                    @if($product->variants->count() > 3)
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">+{{ $product->variants->count() - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <!-- أزرار الإجراءات -->
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    تعديل
                                </a>
                                
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')"
                                            class="w-full bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition-colors flex items-center justify-center">
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- روابط التصفح -->
                <div class="mt-8">
                    {{ $products->links() }}
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