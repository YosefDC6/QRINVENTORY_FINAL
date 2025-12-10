<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MovementsExport implements FromCollection, WithHeadings
{
    protected Collection $movements;

    public function __construct(Collection $movements)
    {
        $this->movements = $movements;
    }

    public function collection()
    {
        return $this->movements->map(function ($m) {
            return [
                'Fecha'        => $m->created_at->format('d/m/Y H:i'),
                'Producto'     => optional($m->product)->name ?? 'Producto eliminado',
                'SKU'          => optional($m->product)->sku ?? '-',
                'Tipo'         => $m->movement_type,
                'Cantidad'     => $m->quantity,
                'Usuario'      => optional($m->user)->name ?? 'Sistema',
                'Nota'         => $m->note ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Producto',
            'SKU',
            'Tipo',
            'Cantidad',
            'Usuario',
            'Nota',
        ];
    }
}
