<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الطلب - متجري</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar موحد -->
    @include('layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">إتمام الطلب</h1>

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
            <!-- نموذج الطلب -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        
                        <!-- معلومات العميل -->
                        <h2 class="text-xl font-bold mb-4">معلومات الشحن</h2>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">الاسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror" 
                                   required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">رقم الهاتف</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" 
                                   class="w-full border rounded p-2 @error('phone') border-red-500 @enderror" 
                                   required>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">البريد الإلكتروني (اختياري)</label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">الولاية</label>
                            <select name="wilaya_id" id="wilaya_select" class="w-full border rounded p-2 @error('wilaya_id') border-red-500 @enderror" required>
                                <option value="">اختر الولاية</option>
                                @foreach($wilayas as $wilaya)
                                <option value="{{ $wilaya->id }}" data-delivery="{{ $wilaya->delivery_price }}" {{ old('wilaya_id') == $wilaya->id ? 'selected' : '' }}>
                                    {{ $wilaya->name }} ({{ number_format($wilaya->delivery_price) }} DA)
                                </option>
                                @endforeach
                            </select>
                            @error('wilaya_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">العنوان الكامل</label>
                            <textarea name="address" rows="3" 
                                      class="w-full border rounded p-2 @error('address') border-red-500 @enderror" 
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- طريقة الدفع -->
                        <h2 class="text-xl font-bold mb-4 mt-8">طريقة الدفع</h2>
                        
                        <div class="space-y-2">
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="cash_on_delivery" checked class="ml-3">
                                <div>
                                    <span class="font-bold">الدفع عند الاستلام</span>
                                    <p class="text-sm text-gray-500">ادفع عند استلام الطلب</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="ccp" class="ml-3">
                                <div>
                                    <span class="font-bold">دفع عبر CCP</span>
                                    <p class="text-sm text-gray-500">حول المبلغ إلى حساب CCP 123456789</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="baridi_mob" class="ml-3">
                                <div>
                                    <span class="font-bold">دفع عبر BaridiMob</span>
                                    <p class="text-sm text-gray-500">ادفع عبر تطبيق بريدي موب</p>
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700 mt-6 transition duration-300">
                            تأكيد الطلب
                        </button>
                    </form>
                </div>
            </div>

            <!-- ملخص الطلب -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20">
                    <h2 class="text-xl font-bold mb-4">ملخص الطلب</h2>
                    
                    <!-- المنتجات -->
                    <div class="max-h-96 overflow-y-auto mb-4">
                        @foreach($cart as $item)
                        <div class="flex justify-between items-center py-2 border-b">
                            <div>
                                <span class="font-bold">{{ $item['name'] }}</span>
                                <span class="text-gray-600 block text-sm">الكمية: {{ $item['quantity'] }}</span>
                            </div>
                            <span class="text-blue-600 font-bold">{{ number_format($item['price'] * $item['quantity']) }} DA</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- الحساب -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between mb-2">
                            <span>مجموع المنتجات</span>
                            <span id="productTotal" class="font-bold">{{ number_format($total) }} DA</span>
                        </div>
                        
                        <div class="flex justify-between mb-2 text-green-600">
                            <span>تكلفة التوصيل</span>
                            <span id="deliveryPrice" class="font-bold">0 DA</span>
                        </div>
                        
                        <div class="flex justify-between text-lg font-bold mt-4 pt-4 border-t">
                            <span>الإجمالي النهائي</span>
                            <span id="finalTotal" class="text-blue-600">{{ number_format($total) }} DA</span>
                        </div>
                    </div>

                    <!-- شعارات الدفع الآمن -->
                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>✓ الدفع آمن ومضمون</p>
                        <p>✓ التوصيل إلى جميع الولايات</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        // حساب تكلفة التوصيل تلقائياً عند اختيار الولاية
        const wilayaSelect = document.getElementById('wilaya_select');
        const productTotal = {{ $total }};
        const deliverySpan = document.getElementById('deliveryPrice');
        const finalTotalSpan = document.getElementById('finalTotal');

        wilayaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const deliveryPrice = selectedOption ? parseFloat(selectedOption.dataset.delivery || 0) : 0;
            
            deliverySpan.textContent = new Intl.NumberFormat().format(deliveryPrice) + ' DA';
            finalTotalSpan.textContent = new Intl.NumberFormat().format(productTotal + deliveryPrice) + ' DA';
        });

        // إذا كان هناك ولاية محددة مسبقاً (old value)
        window.addEventListener('load', function() {
            if (wilayaSelect.value) {
                const event = new Event('change');
                wilayaSelect.dispatchEvent(event);
            }
        });
    </script>
</body>
</html>