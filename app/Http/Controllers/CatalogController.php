<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search');       
        $category_id = $request->input('category_id');   
        $low_stock   = $request->boolean('low_stock');    

        $query = Product::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        if ($low_stock) {
            $query->whereColumn('quantity', '<=', 'min_stock');
        }

        $products = $query
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();      

        $categories = Category::orderBy('name')->get();

        return view('products.catalog', [
            'products'    => $products,
            'categories'  => $categories,
            'search'      => $search,
            'category_id' => $category_id,
            'low_stock'   => $low_stock,   
        ]);
    }
}
