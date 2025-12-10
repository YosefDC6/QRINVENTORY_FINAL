<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ScanController extends Controller
{

    public function index()
    {
        return view('scan.index');
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'sku' => 'required|string',
        ]);

        $product = Product::with('category')->where('sku', $data['sku'])->first();

        if (! $product) {
            return back()->withErrors(['sku' => 'No se encontró un producto con ese SKU.']);
        }

        return view('scan.index', compact('product'));
    }

    public function showBySku(string $sku)
    {
        $product = Product::with('category')->where('sku', $sku)->firstOrFail();

        return view('scan.index', compact('product'));
    }
}
