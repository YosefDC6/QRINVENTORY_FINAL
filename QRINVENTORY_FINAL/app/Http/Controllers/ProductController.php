<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([          
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',   
            'min_stock'   => 'nullable|integer|min:0',
          ]);

       $sku = strtoupper(Str::random(8));

        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'sku'         => $sku,
            'price'       => $request->price,
            'quantity'    => $request->stock,      
            'min_stock'   => $request->min_stock,
            'active'      => true,
        ]);


        $this->generateQrCode($product);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
       $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'min_stock'   => 'nullable|integer|min:0',
        ]);


       $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'quantity'    => $request->stock,    
            'min_stock'   => $request->min_stock,
        ]);

        $this->generateQrCode($product);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->qr_code && Storage::disk('public')->exists($product->qr_code)) {
    Storage::disk('public')->delete($product->qr_code);
    }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado.');
    }

    public function downloadQr(Product $product)
    {
        if (!$product->qr_code || !Storage::disk('public')->exists($product->qr_code)) {
        abort(404);
    }

         $path = Storage::disk('public')->path($product->qr_code);

        return response()->download($path, 'QR_'.$product->sku.'.svg');

    }

    private function generateQrCode(Product $product): void
    {
        $product->loadMissing('category');
        $qrContent = 'http://10.88.228.54:8000/scan/' . $product->sku;
        $fileName = 'qrcodes/product_' . $product->id . '.svg';
        $svg = QrCode::format('svg')
            ->size(300)
            ->margin(2)
            ->generate($qrContent);
        Storage::disk('public')->put($fileName, $svg);
        $product->qr_code = $fileName;
        $product->save();
    }

        public function catalog()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->paginate(12);

        return view('products.catalog', compact('products'));
    }
}
