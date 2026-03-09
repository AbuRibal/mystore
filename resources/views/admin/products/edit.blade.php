<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>تعديل منتج - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar محسنة -->
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
                <a href="{{ route('admin.orders.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="font-medium">الطلبات</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center py-3 px-4 rounded-lg bg-blue-600 transition-colors">
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
            <div class="max-w-4xl mx-auto">
                <!-- رأس الصفحة -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تعديل المنتج</h1>
                        <p class="text-gray-600 mt-1">{{ $product->name }}</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة
                    </a>
                </div>

                <!-- صورة المنتج الحالية (إن وجدت) -->
                @if($product->image)
                <div class="mb-6 bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                    <p class="text-sm text-gray-600 mb-2">الصورة الحالية:</p>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg border">
                </div>
                @endif

                <!-- نموذج التعديل -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-l from-gray-50 to-white p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800">معلومات المنتج</h2>
                    </div>
                    
                    <div class="p-4 md:p-6">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- اسم المنتج -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">اسم المنتج</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('name') border-red-500 @enderror" 
                                       required>
                                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- الوصف -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">الوصف</label>
                                <textarea name="description" rows="5" 
                                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- الأسعار (شبكة متجاوبة) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">السعر (DA)</label>
                                    <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('price') border-red-500 @enderror" 
                                           required>
                                    @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">السعر بعد الخصم</label>
                                    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                                </div>
                            </div>

                            <!-- رابط الصورة -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">رابط الصورة</label>
                                <input type="url" name="image" value="{{ old('image', $product->image) }}" 
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                       placeholder="https://example.com/image.jpg">
                            </div>

                            <!-- حالة المنتج (شبكة متجاوبة) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                    <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} 
                                           class="w-5 h-5 ml-3 text-blue-600 rounded focus:ring-blue-500">
                                    <label class="text-gray-700 font-medium">المنتج نشط</label>
                                </div>
                                
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                    <span class="text-gray-700 font-medium ml-3">تاريخ الإضافة:</span>
                                    <span class="text-gray-600">{{ $product->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>

                            <!-- قسم المتغيرات (variants) -->
                            <div class="mt-8 border-t pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-bold text-gray-800">المتغيرات (الألوان/المقاسات)</h2>
                                    <button type="button" 
                                            onclick="addVariant()"
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition-colors flex items-center">
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        إضافة متغير جديد
                                    </button>
                                </div>

                                <!-- قائمة المتغيرات الموجودة -->
                                <div id="variants-list" class="space-y-3">
                                    @foreach($product->variants as $variant)
                                    <div class="variant-item bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                            <input type="hidden" name="existing_variants[{{ $loop->index }}][id]" value="{{ $variant->id }}">
                                            
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">الاسم</label>
                                                <input type="text" 
                                                    name="existing_variants[{{ $loop->index }}][name]" 
                                                    value="{{ $variant->name }}"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    placeholder="مثال: أحمر، XL، ..."
                                                    required>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">السعر (اختياري)</label>
                                                <input type="number" 
                                                    name="existing_variants[{{ $loop->index }}][price]" 
                                                    value="{{ $variant->price }}"
                                                    step="0.01"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    placeholder="اترك فارغاً لاستخدام سعر المنتج">
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">المخزون</label>
                                                <input type="number" 
                                                    name="existing_variants[{{ $loop->index }}][stock]" 
                                                    value="{{ $variant->stock }}"
                                                    min="0"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    required>
                                            </div>
                                            
                                            <div class="flex items-end">
                                                <button type="button" 
                                                        onclick="removeVariant(this, {{ $variant->id }})"
                                                        class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-600 transition-colors flex items-center">
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- رسالة تحذير إذا كان المخزون منخفض -->
                                        @if($variant->stock < 5)
                                        <div class="mt-2 text-sm text-orange-600 flex items-center">
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                            <span>المخزون منخفض ({{ $variant->stock }} قطع متبقية)</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                                <!-- قالب للمتغير الجديد (يتم استنساخه بالجافاسكريبت) -->
                                <template id="variant-template">
                                    <div class="variant-item bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">الاسم</label>
                                                <input type="text" 
                                                    name="new_variants[INDEX][name]" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    placeholder="مثال: أحمر، XL، ..."
                                                    required>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">السعر (اختياري)</label>
                                                <input type="number" 
                                                    name="new_variants[INDEX][price]" 
                                                    step="0.01"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    placeholder="اترك فارغاً لاستخدام سعر المنتج">
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm text-gray-600 mb-1">المخزون</label>
                                                <input type="number" 
                                                    name="new_variants[INDEX][stock]" 
                                                    min="0"
                                                    value="0"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-200"
                                                    required>
                                            </div>
                                            
                                            <div class="flex items-end">
                                                <button type="button" 
                                                        onclick="removeVariant(this)"
                                                        class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-600 transition-colors flex items-center">
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    إلغاء
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- ملاحظات مهمة -->
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg text-sm text-blue-800">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>إذا تركت السعر فارغاً، سيتم استخدام سعر المنتج الرئيسي</li>
                                        <li>المخزون 0 يعني أن المتغير غير متوفر حالياً</li>
                                        <li>يمكنك إضافة متغيرات متعددة (ألوان، مقاسات، إصدارات)</li>
                                    </ul>
                                </div>
                            </div>
            
                            <script>
                            let variantIndex = {{ $product->variants->count() }};

                            function addVariant() {
                                const template = document.getElementById('variant-template');
                                const clone = template.content.cloneNode(true);
                                
                                // تحديث الـ indices
                                const html = clone.querySelector('.variant-item').outerHTML.replace(/INDEX/g, variantIndex);
                                
                                // إضافة المتغير الجديد للقائمة
                                const container = document.getElementById('variants-list');
                                container.insertAdjacentHTML('beforeend', html);
                                
                                variantIndex++;
                            }

                            function removeVariant(button, variantId = null) {
                                if (variantId) {
                                    // إذا كان المتغير موجوداً في قاعدة البيانات، نضيف حذفاً مخفياً
                                    if (confirm('هل أنت متأكد من حذف هذا المتغير؟')) {
                                        const form = button.closest('form');
                                        const input = document.createElement('input');
                                        input.type = 'hidden';
                                        input.name = 'delete_variants[]';
                                        input.value = variantId;
                                        form.appendChild(input);
                                        
                                        // إخفاء المتغير من الواجهة
                                        button.closest('.variant-item').style.display = 'none';
                                    }
                                } else {
                                    // إذا كان متغيراً جديداً، نحذفه مباشرة
                                    button.closest('.variant-item').remove();
                                }
                            }
                            </script>

                            <!-- أزرار الإجراءات -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="submit" 
                                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all duration-200 transform hover:scale-105 focus:scale-95 flex items-center justify-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    تحديث المنتج
                                </button>
                                
                                <a href="{{ route('admin.products.index') }}" 
                                   class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-gray-600 transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- قسم المتغيرات (variants) - يمكن إضافته لاحقاً -->
                @if($product->variants && $product->variants->count() > 0)
                <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-l from-gray-50 to-white p-4 border-b">
                        <h2 class="text-lg font-bold text-gray-800">المتغيرات (الألوان/المقاسات)</h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($product->variants as $variant)
                            <div class="bg-gray-50 p-3 rounded-lg flex justify-between items-center">
                                <div>
                                    <span class="font-medium">{{ $variant->name }}</span>
                                    <span class="text-sm text-gray-600 block">{{ number_format($variant->price ?? $product->price) }} DA</span>
                                </div>
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded">المخزون: {{ $variant->stock }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
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