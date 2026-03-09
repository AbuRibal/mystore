<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-blue-600">404</h1>
        <h2 class="text-3xl font-bold text-gray-800 mt-4">الصفحة غير موجودة</h2>
        <p class="text-gray-600 mt-4">عذراً، الصفحة التي تبحث عنها غير متوفرة</p>
        <a href="{{ route('home') }}" class="inline-block mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
            العودة للرئيسية
        </a>
    </div>
</body>
</html>