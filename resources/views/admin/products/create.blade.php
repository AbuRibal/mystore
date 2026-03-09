<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">لوحة التحكم</h2>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 hover:bg-gray-700">الطلبات</a>
                <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 bg-gray-700">المنتجات</a>
                <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-gray-700">العودة للمتجر</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="px-6 py-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold">إضافة منتج جديد</h1>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        عودة
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('admin.products.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">اسم المنتج</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">الوصف</label>
                            <textarea name="description" rows="5" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">السعر (DA)</label>
                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="w-full border rounded p-2 @error('price') border-red-500 @enderror" required>
                                @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">السعر بعد الخصم (اختياري)</label>
                                <input type="number" name="sale_price" value="{{ old('sale_price') }}" step="0.01" class="w-full border rounded p-2">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">رابط الصورة</label>
                            <input type="url" name="image" value="{{ old('image') }}" class="w-full border rounded p-2" placeholder="https://...">
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked class="ml-2">
                                <span class="text-gray-700 font-bold">المنتج نشط</span>
                            </label>
                        </div>

                        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700">
                            حفظ المنتج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>