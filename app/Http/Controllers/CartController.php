<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * عرض محتويات السلة
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateCartTotal($cart);
        
        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * إضافة منتج إلى السلة
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:variants,id'
        ]);

        $cart = session()->get('cart', []);
        $product = Product::with('variants')->find($request->product_id);
        
        $itemId = $request->variant_id ?? $request->product_id;
        
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $request->quantity;
        } else {
            $cart[$itemId] = [
                'product_id' => $product->id,
                'variant_id' => $request->variant_id,
                'name' => $product->name,
                'price' => $this->getItemPrice($product, $request->variant_id),
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'تم إضافة المنتج إلى السلة');
    }

    /**
     * تحديث كمية منتج في السلة
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'تم تحديث السلة');
    }

    /**
     * حذف منتج من السلة
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'تم حذف المنتج من السلة');
    }

    /**
     * تفريغ السلة بالكامل
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'تم إفراغ السلة');
    }

    /**
     * الحصول على سعر المنتج (مع مراعاة المتغيرات)
     */
    private function getItemPrice($product, $variantId = null)
    {
        if ($variantId) {
            $variant = $product->variants->find($variantId);
            return $variant->price ?? $product->final_price;
        }
        
        return $product->final_price;
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
}