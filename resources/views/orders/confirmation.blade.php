<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الطلب - متجري</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('layouts.navbar')
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <!-- نفس الكود السابق -->
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-16">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <!-- أيقونة نجاح -->
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-green-600 mb-4">تم تأكيد طلبك بنجاح!</h1>
            
            <p class="text-gray-600 mb-4">
                رقم الطلب: <span class="font-bold text-xl">{{ $order->order_number }}</span>
            </p>
            
            <p class="text-gray-600 mb-8">
                سنقوم بالتواصل معك قريباً لتأكيد الطلب وتفاصيل التوصيل
            </p>

            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-right">
                <h2 class="font-bold text-lg mb-4">تفاصيل الطلب</h2>
                
                <div class="space-y-2">
                    <p><span class="font-bold">الاسم:</span> {{ $order->customer_name }}</p>
                    <p><span class="font-bold">الهاتف:</span> {{ $order->customer_phone }}</p>
                    <p><span class="font-bold">الولاية:</span> {{ $order->wilaya->name }}</p>
                    <p><span class="font-bold">العنوان:</span> {{ $order->address }}</p>
                    <p><span class="font-bold">طريقة الدفع:</span> 
                        @if($order->payment_method == 'cash_on_delivery')
                            الدفع عند الاستلام
                        @elseif($order->payment_method == 'ccp')
                            دفع عبر CCP
                        @else
                            دفع عبر BaridiMob
                        @endif
                    </p>
                </div>

                <div class="border-t mt-4 pt-4">
                    <p class="font-bold text-lg">
                        الإجمالي: {{ number_format($order->total) }} DA
                    </p>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('home') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    العودة للرئيسية
                </a>
                <a href="{{ route('products.index') }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">
                    متابعة التسوق
                </a>
            </div>
        </div>
    </div>
</body>
</html>