<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متجري الإلكتروني</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    @include('layouts.navbar')

    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">مرحباً بكم في متجرنا</h1>
            <p class="text-xl mb-8">أفضل المنتجات بأفضل الأسعار</p>
            <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100">
                تسوق الآن
            </a>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold mb-8 text-center">منتجات مميزة</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 50) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-600">{{ number_format($product->final_price) }} DA</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>جميع الحقوق محفوظة &copy; 2026</p>
        </div>
    </footer>
</body>
</html>