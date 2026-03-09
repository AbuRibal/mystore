<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    /**
     * عرض جميع المنتجات
     */
    public function index()
    {
        $products = Product::with('variants')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * عرض صفحة إضافة منتج جديد
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * حفظ منتج جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $request->image,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * عرض صفحة تعديل منتج
     */
    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * تحديث منتج
     */

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        // تحديث المنتج
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'image' => $request->image,
            'is_active' => $request->is_active ?? true
        ]);

        // تحديث المتغيرات الموجودة
        if ($request->has('existing_variants')) {
            foreach ($request->existing_variants as $variantData) {
                if (isset($variantData['id'])) {
                    $variant = Variant::find($variantData['id']);
                    if ($variant) {
                        $variant->update([
                            'name' => $variantData['name'],
                            'price' => !empty($variantData['price']) ? $variantData['price'] : null,
                            'stock' => $variantData['stock']
                        ]);
                    }
                }
            }
        }

        // إضافة متغيرات جديدة
        if ($request->has('new_variants')) {
            foreach ($request->new_variants as $variantData) {
                if (!empty($variantData['name'])) {
                    $product->variants()->create([
                        'name' => $variantData['name'],
                        'price' => !empty($variantData['price']) ? $variantData['price'] : null,
                        'stock' => $variantData['stock'] ?? 0
                    ]);
                }
            }
        }

        // حذف المتغيرات المحددة
        if ($request->has('delete_variants')) {
            Variant::whereIn('id', $request->delete_variants)->delete();
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج والمتغيرات بنجاح');
    }

    /**
     * حذف منتج
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }

    /**
     * إضافة متغير لمنتج (لون/مقاس)
     */
    public function addVariant(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $variant = Variant::create([
            'product_id' => $productId,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return response()->json(['success' => true, 'variant' => $variant]);
    }

    /**
     * حذف متغير
     */
    public function deleteVariant($id)
    {
        $variant = Variant::findOrFail($id);
        $variant->delete();

        return response()->json(['success' => true]);
    }
}