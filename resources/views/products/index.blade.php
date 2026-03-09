<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المنتجات - متجري</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    @include('layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- رأس الصفحة مع البحث -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">جميع المنتجات</h1>
            
            <!-- شريط البحث -->
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="ابحث عن منتج..." 
                           class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                    <svg class="w-5 h-5 absolute left-4 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    بحث
                </button>
                
                @if(request('search'))
                <a href="{{ route('products.index') }}" 
                   class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    إلغاء
                </a>
                @endif
            </form>
            
            <!-- عرض نتائج البحث -->
            @if(request('search'))
            <div class="mt-4 text-gray-600">
                نتائج البحث عن: <span class="font-bold text-blue-600">"{{ request('search') }}"</span>
                ({{ $products->total() }} منتج)
            </div>
            @endif
        </div>

        <!-- شبكة المنتجات -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- صورة المنتج -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300?text='.urlencode($product->name) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    
                    @if($product->sale_price)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        خصم {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                    </div>
                    @endif
                </div>
                
                <!-- محتوى البطاقة -->
                <div class="p-5">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    
                    <!-- السعر -->
                    <div class="mb-4">
                        @if($product->sale_price)
                        <div class="flex items-center">
                            <span class="text-2xl font-bold text-red-600">{{ number_format($product->sale_price) }} DA</span>
                            <span class="text-sm text-gray-400 line-through mr-2">{{ number_format($product->price) }} DA</span>
                        </div>
                        @else
                        <span class="text-2xl font-bold text-blue-600">{{ number_format($product->price) }} DA</span>
                        @endif
                    </div>

                    <!-- نموذج الإضافة للسلة -->
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        
                        @if($product->variants->count() > 0)
                        <div>
                            <select name="variant_id" class="w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}" {{ $variant->stock < 1 ? 'disabled' : '' }}>
                                    {{ $variant->name }} - {{ number_format($variant->price ?? $product->price) }} DA
                                    ({{ $variant->stock > 0 ? 'متوفر: '.$variant->stock : 'غير متوفر' }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-l from-blue-600 to-blue-700 text-white px-4 py-3 rounded-xl font-bold hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-105 focus:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            أضف إلى السلة
                        </button>
                    </form>
                    
                    <!-- رابط التفاصيل -->
                    <a href="{{ route('products.show', $product->slug) }}" 
                       class="mt-3 text-blue-600 hover:text-blue-800 text-sm flex items-center justify-center">
                        عرض التفاصيل
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <!-- لا توجد نتائج -->
            <div class="col-span-full text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">لا توجد منتجات</h3>
                <p class="text-gray-500">لم نتمكن من العثور على منتجات تطابق بحثك</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    عرض جميع المنتجات
                </a>
            </div>
            @endforelse
        </div>

        <!-- روابط التصفح -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>