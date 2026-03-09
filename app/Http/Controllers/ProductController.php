<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * عرض جميع المنتجات مع إمكانية البحث
     */
    public function index(Request $request)
    {
        $query = Product::with('variants')->where('is_active', true);
        
        // البحث عن المنتجات
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // ترتيب النتائج (اختياري)
        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate(12)->withQueryString();
        
        return view('products.index', compact('products'));
    }

    /**
     * عرض صفحة منتج واحد
     */
    public function show($slug)
    {
        $product = Product::with('variants')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        return view('products.show', compact('product'));
    }



}