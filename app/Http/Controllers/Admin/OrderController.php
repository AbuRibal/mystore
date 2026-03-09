<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * عرض جميع الطلبات
     */
    public function index()
    {
        $orders = Order::with(['items.product', 'wilaya'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * عرض تفاصيل طلب معين
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'wilaya'])
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    /**
     * حذف طلب (اختياري)
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}