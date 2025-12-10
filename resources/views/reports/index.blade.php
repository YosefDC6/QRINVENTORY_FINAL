<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Reportes de movimientos de inventario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        Filtros de búsqueda
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('reports.export.excel', request()->query()) }}"
                           class="inline-flex items-center px-3 py-2 rounded-md text-xs font-semibold
                                  text-green-800 bg-green-100 hover:bg-green-200 border border-green-300">
                            Exportar a Excel
                        </a>

                        <a href="{{ route('reports.export.pdf', request()->query()) }}"
                           class="inline-flex items-center px-3 py-2 rounded-md text-xs font-semibold
                                  text-red-800 bg-red-100 hover:bg-red-200 border border-red-300">
                            Exportar a PDF
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 mb-1 text-xs">
                            Fecha desde
                        </label>
                        <input type="date" name="from"
                               value="{{ request('from') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 mb-1 text-xs">
                            Fecha hasta
                        </label>
                        <input type="date" name="to"
                               value="{{ request('to') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 mb-1 text-xs">
                            Tipo de movimiento
                        </label>
                        <select name="movement_type"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            <option value="entrada" {{ request('movement_type') === 'entrada' ? 'selected' : '' }}>Entradas</option>
                            <option value="salida"  {{ request('movement_type') === 'salida'  ? 'selected' : '' }}>Salidas</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 mb-1 text-xs">
                            Producto
                        </label>
                        <select name="product_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (SKU: {{ $product->sku }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1 text-xs">
                            Usuario
                        </label>
                        <select name="user_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2 flex items-end gap-3">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold tracking-wide
                                       text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                                       focus:ring-offset-2 focus:ring-indigo-500">
                            Aplicar filtros
                        </button>

                        <a href="{{ route('reports.index') }}"
                           class="inline-flex items-center px-3 py-2 rounded-md text-xs font-medium border
                                  border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200
                                  bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Resumen del periodo filtrado
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="text-xs text-gray-500 dark:text-gray-400">Movimientos totales</div>
                        <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $totalMovements }}
                        </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="text-xs text-gray-500 dark:text-gray-400">Entradas (cantidad)</div>
                        <div class="mt-2 text-2xl font-bold text-green-600">
                            {{ $totalEntries }}
                        </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="text-xs text-gray-500 dark:text-gray-400">Salidas (cantidad)</div>
                        <div class="mt-2 text-2xl font-bold text-red-600">
                            {{ $totalExits }}
                        </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="text-xs text-gray-500 dark:text-gray-400">Productos con movimiento</div>
                        <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $uniqueProducts }}
                        </div>
                    </div>
                </div>

                @if ($topProduct && $topProduct['product'])
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Producto más movido
                        </h4>
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                            <span class="font-medium">
                                {{ $topProduct['product']->name }}
                            </span>
                            <span class="text-xs text-gray-500">
                                (SKU: {{ $topProduct['product']->sku }})
                            </span>
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Entradas: <span class="font-semibold text-green-600">{{ $topProduct['entries'] }}</span> ·
                            Salidas: <span class="font-semibold text-red-600">{{ $topProduct['exits'] }}</span> ·
                            Neto: <span class="font-semibold">{{ $topProduct['net'] }}</span>
                        </p>
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="px-4 py-4 sm:px-6 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        Movimientos encontrados
                    </h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $movements->total() }} registros
                    </span>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700">
                    @if ($movements->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900 text-xs uppercase text-gray-500 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-2 text-left">Fecha</th>
                                    <th class="px-4 py-2 text-left">Producto</th>
                                    <th class="px-4 py-2 text-center">Tipo</th>
                                    <th class="px-4 py-2 text-right">Cantidad</th>
                                    <th class="px-4 py-2 text-left">Usuario</th>
                                    <th class="px-4 py-2 text-left">Nota</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($movements as $movement)
                                    <tr>
                                        <td class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $movement->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="text-gray-900 dark:text-gray-100">
                                                {{ $movement->product->name ?? 'Producto eliminado' }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                SKU: {{ $movement->product->sku ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            @if ($movement->movement_type === 'entrada')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                    Entrada
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                                    Salida
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-right text-gray-900 dark:text-gray-100">
                                            {{ $movement->quantity }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">
                                            {{ $movement->user->name ?? 'Sistema' }}
                                        </td>
                                        <td class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $movement->note ?? '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                            {{ $movements->links() }}
                        </div>
                    @else
                        <div class="px-4 py-6 text-sm text-gray-500 dark:text-gray-300">
                            No se encontraron movimientos con los filtros seleccionados.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
