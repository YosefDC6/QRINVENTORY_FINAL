<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryMovementController extends Controller
{
    public function index()
    {
        $movements = InventoryMovement::with(['product', 'user'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('movements.create', compact('products'));
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'movement_type'  => 'required|in:entrada,salida',
            'quantity'       => 'required|integer|min:1',
            'note'           => 'nullable|string|max:500',
        ], [
            'product_id.required'    => 'Selecciona un producto.',
            'product_id.exists'      => 'El producto seleccionado no existe.',
            'movement_type.required' => 'Selecciona el tipo de movimiento.',
            'movement_type.in'       => 'El tipo de movimiento no es válido.',
            'quantity.required'      => 'Ingresa una cantidad.',
            'quantity.integer'       => 'La cantidad debe ser un número entero.',
            'quantity.min'           => 'La cantidad mínima es 1.',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->movement_type === 'salida' && $request->quantity > $product->quantity) {
            return back()
                ->withErrors([
                    'quantity' => 'No hay suficiente stock para registrar esta salida. ' .
                                  'Stock actual: ' . $product->quantity,
                ])
                ->withInput();
        }
     
        DB::transaction(function () use ($request, $product) {
            $movement = new InventoryMovement();
            $movement->product_id    = $product->id;
            $movement->user_id       = Auth::id();
            $movement->movement_type = $request->movement_type;
            $movement->quantity      = $request->quantity;
            $movement->note          = $request->note;
            $movement->save();

            if ($request->movement_type === 'entrada') {
                $product->quantity += $request->quantity;
            } else { 
                $product->quantity -= $request->quantity;
            }

            $product->save();
        });

        return redirect()
            ->route('movements.index')
            ->with('success', 'Movimiento registrado correctamente y stock actualizado.');
    }
}
