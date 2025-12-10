<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de movimientos de inventario</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111;
        }
        h1, h2, h3 {
            margin: 0 0 10px 0;
        }
        .small {
            font-size: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 4px 6px;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>QRInventory - Reporte de movimientos</h2>
    <p class="small">
        Generado: {{ now()->format('d/m/Y H:i') }}<br>
        @if ($from || $to || $movement_type)
            Filtros:
            @if ($from) Desde {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} @endif
            @if ($to) | Hasta {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }} @endif
            @if ($movement_type) | Tipo: {{ ucfirst($movement_type) }} @endif
        @else
            Sin filtros aplicados.
        @endif
    </p>

    <table>
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>SKU</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Usuario</th>
            <th>Nota</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($movements as $m)
            <tr>
                <td class="small">
                    {{ $m->created_at->format('d/m/Y H:i') }}
                </td>
                <td>
                    {{ $m->product->name ?? 'Producto eliminado' }}
                </td>
                <td class="small">
                    {{ $m->product->sku ?? '-' }}
                </td>
                <td class="small text-center">
                    {{ ucfirst($m->movement_type) }}
                </td>
                <td class="text-right">
                    {{ $m->quantity }}
                </td>
                <td class="small">
                    {{ $m->user->name ?? 'Sistema' }}
                </td>
                <td class="small">
                    {{ $m->note ?? '' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center small">
                    No se encontraron movimientos con los filtros seleccionados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
