<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق - متجري</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('layouts.navbar')
    
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <!-- نفس الكود السابق -->
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">سلة التسوق</h1>

        @if(empty($cart))
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <p class="text-gray-600 mb-4">السلة فارغة</p>
            <a href="{{ route('products.index') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                تسوق الآن
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- عناصر السلة -->
            <div class="lg:col-span-2">
                @foreach($cart as $id => $item)
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
                    <div class="flex items-center">
                        <img src="{{ $item['image'] ?? 'https://via.placeholder.com/100' }}" 
                             alt="{{ $item['name'] }}" 
                             class="w-24 h-24 object-cover rounded">
                        
                        <div class="flex-grow mr-4">
                            <h3 class="font-bold text-lg">{{ $item['name'] }}</h3>
                            <p class="text-blue-600 font-bold">{{ number_format($item['price']) }} DA</p>
                            
                            <div class="flex items-center mt-2">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                           min="1" class="w-16 border rounded p-1 ml-2">
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                        تحديث
                                    </button>
                                </form>
                                
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="mr-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="text-left">
                            <span class="font-bold">
                                {{ number_format($item['price'] * $item['quantity']) }} DA
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        تفريغ السلة
                    </button>
                </form>
            </div>

            <!-- ملخص الطلب -->
            <div class="bg-white rounded-lg shadow-lg p-6 h-fit">
                <h2 class="text-xl font-bold mb-4">ملخص الطلب</h2>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between mb-2">
                        <span>المجموع</span>
                        <span class="font-bold">{{ number_format($total) }} DA</span>
                    </div>
                    
                    <a href="{{ route('checkout') }}" 
                       class="block bg-green-600 text-white text-center px-6 py-3 rounded-lg font-bold hover:bg-green-700 mt-4">
                        إتمام الطلب
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>