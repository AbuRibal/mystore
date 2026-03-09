<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - متجري</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('layouts.navbar')
    <!-- Header -->

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- صورة المنتج -->
                <div>
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/600' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full rounded-lg">
                    
                    @if($product->gallery)
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        @foreach($product->gallery as $image)
                        <img src="{{ $image }}" class="w-full h-20 object-cover rounded cursor-pointer">
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- معلومات المنتج -->
                <div>
                    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                    
                    <!-- السعر -->
                    <div class="mb-4">
                        @if($product->sale_price)
                        <span class="text-3xl text-red-600 font-bold">{{ number_format($product->sale_price) }} DA</span>
                        <span class="text-xl text-gray-500 line-through mr-2">{{ number_format($product->price) }} DA</span>
                        @else
                        <span class="text-3xl text-blue-600 font-bold">{{ number_format($product->price) }} DA</span>
                        @endif
                    </div>

                    <!-- الوصف -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold mb-2">الوصف</h2>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <!-- إضافة إلى السلة -->
                    <form action="{{ route('cart.add') }}" method="POST" class="border-t pt-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <!-- المتغيرات (الأحجام/الألوان) -->
                        @if($product->variants->count() > 0)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">الخيارات المتاحة</label>
                            <select name="variant_id" class="w-full border rounded p-2" required>
                                <option value="">اختر</option>
                                @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}">
                                    {{ $variant->name }} - 
                                    @if($variant->price)
                                        {{ number_format($variant->price) }} DA
                                    @else
                                        {{ number_format($product->final_price) }} DA
                                    @endif
                                    (المتوفر: {{ $variant->stock }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- الكمية -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">الكمية</label>
                            <input type="number" name="quantity" value="1" min="1" 
                                   class="w-24 border rounded p-2">
                        </div>

                        <button type="submit" 
                                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 w-full">
                            أضف إلى السلة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>