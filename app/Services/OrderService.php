<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Wilaya;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $wilaya = Wilaya::find($data['wilaya_id']);
            
            // إنشاء الطلب
            $order = Order::create([
                'order_number' => 'ORD-' . uniqid(),
                'customer_name' => $data['name'],
                'customer_phone' => $data['phone'],
                'customer_email' => $data['email'] ?? null,
                'wilaya_id' => $wilaya->id,
                'address' => $data['address'],
                'total' => $this->calculateTotal($data['items'], $wilaya->delivery_price),
                'status' => 'pending',
                'payment_method' => $data['payment_method']
            ]);

            // إضافة عناصر الطلب وتحديث المخزون
            foreach ($data['items'] as $item) {
                // إنشاء عنصر الطلب
                $orderItem = $order->items()->create([
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // تحديث المخزون إذا كان هناك variant_id
                if (isset($item['variant_id']) && !empty($item['variant_id'])) {
                    $variant = Variant::find($item['variant_id']);
                    if ($variant) {
                        $oldStock = $variant->stock;
                        $newStock = max(0, $oldStock - $item['quantity']);
                        
                        $variant->update(['stock' => $newStock]);
                        
                        // تسجيل تحذير إذا أصبح المخزون منخفضاً
                        if ($newStock < 5 && $newStock > 0) {
                            Log::warning("مخزون منخفض للمتغير: {$variant->name} (ID: {$variant->id}) - المتبقي: {$newStock}");
                        }
                        
                        // تسجيل إذا نفذ المخزون
                        if ($newStock == 0) {
                            Log::info("المتغير نفد من المخزون: {$variant->name} (ID: {$variant->id})");
                        }
                    }
                }
            }

            return $order;
        });
    }

    /**
     * حساب المجموع الكلي (منتجات + توصيل)
     */
    private function calculateTotal(array $items, float $deliveryPrice): float
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal + $deliveryPrice;
    }

    /**
     * التحقق من توفر المخزون قبل إنشاء الطلب
     */
    public function checkStockAvailability(array $items): array
    {
        $unavailableItems = [];
        
        foreach ($items as $item) {
            if (isset($item['variant_id']) && !empty($item['variant_id'])) {
                $variant = Variant::find($item['variant_id']);
                
                if (!$variant) {
                    $unavailableItems[] = [
                        'name' => 'منتج غير معروف',
                        'message' => 'المتغير غير موجود'
                    ];
                } elseif ($variant->stock < $item['quantity']) {
                    $unavailableItems[] = [
                        'name' => $variant->product->name ?? 'منتج',
                        'variant' => $variant->name,
                        'available' => $variant->stock,
                        'requested' => $item['quantity']
                    ];
                }
            }
        }
        
        return $unavailableItems;
    }
}