<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\User;
use App\Exports\MovementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('name')->get();
        $users    = User::orderBy('name')->get();
        $query = $this->buildFilteredQuery($request);
        $movements = $query->paginate(15)->withQueryString();
        $allMovements = $query->get();

        $totalMovements = $allMovements->count();
        $totalEntries   = $allMovements->where('movement_type', 'entrada')->sum('quantity');
        $totalExits     = $allMovements->where('movement_type', 'salida')->sum('quantity');
        $uniqueProducts = $allMovements->pluck('product_id')->filter()->unique()->count();

        $topProduct = $allMovements
            ->groupBy('product_id')
            ->map(function ($group) {
                return [
                    'product' => optional($group->first()->product),
                    'entries' => $group->where('movement_type', 'entrada')->sum('quantity'),
                    'exits'   => $group->where('movement_type', 'salida')->sum('quantity'),
                    'net'     => $group->where('movement_type', 'entrada')->sum('quantity')
                                     - $group->where('movement_type', 'salida')->sum('quantity'),
                ];
            })
            ->sortByDesc(function ($item) {
                return ($item['entries'] + $item['exits']);
            })
            ->first();

        return view('reports.index', compact(
            'products',
            'users',
            'movements',
            'totalMovements',
            'totalEntries',
            'totalExits',
            'uniqueProducts',
            'topProduct',
            'request'
        ));
    }

    public function exportExcel(Request $request)
    {
        $query      = $this->buildFilteredQuery($request);
        $movements  = $query->get();

        $fileName = 'reporte_movimientos_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new MovementsExport($movements), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $query      = $this->buildFilteredQuery($request);
        $movements  = $query->get();

        $pdf = Pdf::loadView('reports.pdf', [
            'movements' => $movements,
            'from'      => $request->input('from'),
            'to'        => $request->input('to'),
            'movement_type' => $request->input('movement_type'),
        ])->setPaper('A4', 'portrait');

        $fileName = 'reporte_movimientos_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    private function buildFilteredQuery(Request $request)
    {
        $query = InventoryMovement::with(['product', 'user'])
            ->orderByDesc('created_at');

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=' . ' ' . $request->input('to'));
            $query->whereDate('created_at', '<=', $request->input('to'));
        }

        if ($request->filled('movement_type') && in_array($request->movement_type, ['entrada', 'salida'])) {
            $query->where('movement_type', $request->movement_type);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return $query;
    }
}
