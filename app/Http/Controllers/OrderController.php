<?php

namespace App\Http\Controllers;

use App\Models\Wilaya;
use App\Models\Order;
use App\Models\Variant;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $paymentService;

    public function __construct(OrderService $orderService, PaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    /**
     * عرض صفحة إتمام الطلب
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // التحقق من المخزون قبل عرض صفحة الدفع
        $stockCheck = $this->checkCartStock($cart);
        if (!empty($stockCheck['unavailable'])) {
            return redirect()->route('cart.index')
                ->with('error', $stockCheck['message']);
        }

        $wilayas = Wilaya::all();
        $total = $this->calculateCartTotal($cart);
        
        return view('checkout.index', compact('cart', 'wilayas', 'total'));
    }

    /**
     * حفظ الطلب في قاعدة البيانات
     */
    public function store(OrderRequest $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // التحقق النهائي من المخزون قبل إنشاء الطلب
        $stockCheck = $this->checkCartStock($cart);
        if (!empty($stockCheck['unavailable'])) {
            return redirect()->route('cart.index')
                ->with('error', $stockCheck['message']);
        }

        // تجهيز بيانات الطلب
        $orderData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'wilaya_id' => $request->wilaya_id,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'items' => $this->prepareCartItems($cart)
        ];

        try {
            // إنشاء الطلب (سيتم تحديث المخزون تلقائياً داخل OrderService)
            $order = $this->orderService->createOrder($orderData);

            // معالجة الدفع
            $paymentResult = $this->paymentService->processPayment($order, $request->payment_method);

            // تفريغ السلة
            session()->forget('cart');

            return redirect()->route('orders.confirmation', $order->id)
                ->with('success', 'تم إنشاء الطلب بنجاح');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * عرض صفحة تأكيد الطلب
     */
    public function confirmation($id)
    {
        $order = Order::with(['items.product', 'wilaya'])->findOrFail($id);
        return view('orders.confirmation', compact('order'));
    }

    /**
     * تتبع الطلب (اختياري)
     */
    public function track($orderNumber)
    {
        $order = Order::with(['items.product', 'wilaya'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();
        
        return view('orders.track', compact('order'));
    }

    /**
     * حساب المجموع الكلي للسلة
     */
    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * تجهيز عناصر السلة للتخزين
     */
    private function prepareCartItems($cart)
    {
        $items = [];
        foreach ($cart as $item) {
            $items[] = [
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
        }
        return $items;
    }

    /**
     * التحقق من توفر المخزون في السلة
     */
    private function checkCartStock($cart)
    {
        $unavailable = [];
        $message = '';

        foreach ($cart as $item) {
            if (isset($item['variant_id']) && !empty($item['variant_id'])) {
                $variant = Variant::with('product')->find($item['variant_id']);
                
                if (!$variant) {
                    $unavailable[] = [
                        'name' => 'منتج غير معروف',
                        'message' => 'المتغير غير موجود'
                    ];
                } elseif ($variant->stock < $item['quantity']) {
                    $unavailable[] = [
                        'name' => $variant->product->name ?? 'منتج',
                        'variant' => $variant->name,
                        'available' => $variant->stock,
                        'requested' => $item['quantity']
                    ];
                }
            }
        }

        if (!empty($unavailable)) {
            $message = 'بعض المنتجات غير متوفرة بالكمية المطلوبة:\n';
            foreach ($unavailable as $item) {
                $message .= "• {$item['name']}";
                if (isset($item['variant'])) {
                    $message .= " ({$item['variant']})";
                }
                $message .= " - المتوفر: {$item['available']}\n";
            }
        }

        return [
            'unavailable' => $unavailable,
            'message' => $message
        ];
    }
}