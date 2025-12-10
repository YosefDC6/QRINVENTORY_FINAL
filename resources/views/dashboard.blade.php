<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel principal · QRInventory
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl p-5">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Productos registrados
                    </div>
                    <div class="mt-3 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $productsCount }}
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        Total de productos activos en el inventario.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl p-5">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Categorías
                    </div>
                    <div class="mt-3 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $categoriesCount }}
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        Agrupaciones para organizar tus productos.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl p-5">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Stock bajo o crítico
                    </div>
                    <div class="mt-3 text-3xl font-bold text-red-500">
                        {{ $lowStockCount }}
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        Productos con cantidad menor o igual a su stock mínimo.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl p-5">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Movimientos hoy
                    </div>
                    <div class="mt-3 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $movementsToday }}
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        Entradas y salidas registradas en la fecha actual.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Productos con stock bajo
                        </h3>
                        <a href="{{ route('products.index') }}"
                           class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                            Ver todos
                        </a>
                    </div>

                    @if ($lowStockProducts->count())
                        <div class="px-5 py-3 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs uppercase text-gray-500 dark:text-gray-400">
                                <tr>
                                    <th class="py-2 text-left">Producto</th>
                                    <th class="py-2 text-right">Stock</th>
                                    <th class="py-2 text-right">Mínimo</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($lowStockProducts as $product)
                                    <tr>
                                        <td class="py-2 pr-4">
                                            <div class="text-gray-900 dark:text-gray-100">
                                                {{ $product->name }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                SKU: {{ $product->sku }}
                                                @if ($product->category)
                                                    · {{ $product->category->name }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-2 text-right text-sm text-red-400 font-semibold">
                                            {{ $product->quantity }}
                                        </td>
                                        <td class="py-2 text-right text-xs text-gray-400">
                                            {{ $product->min_stock }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-5 py-6 text-sm text-gray-500 dark:text-gray-300">
                            No hay productos con stock bajo. 
                        </div>
                    @endif
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-xl">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Movimientos recientes
                        </h3>
                        <a href="{{ route('movements.index') }}"
                           class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                            Ver historial
                        </a>
                    </div>

                    @if ($recentMovements->count())
                        <div class="px-5 py-3 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs uppercase text-gray-500 dark:text-gray-400">
                                <tr>
                                    <th class="py-2 text-left">Fecha</th>
                                    <th class="py-2 text-left">Producto</th>
                                    <th class="py-2 text-center">Tipo</th>
                                    <th class="py-2 text-right">Cant.</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($recentMovements as $movement)
                                    <tr>
                                        <td class="py-2 text-xs text-gray-400">
                                            {{ $movement->created_at->format('d/m H:i') }}
                                        </td>
                                        <td class="py-2 pr-4">
                                            <div class="text-gray-900 dark:text-gray-100">
                                                {{ $movement->product->name ?? 'Producto eliminado' }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                Usuario: {{ $movement->user->name ?? 'Sistema' }}
                                            </div>
                                        </td>
                                        <td class="py-2 text-center">
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
                                        <td class="py-2 text-right text-gray-900 dark:text-gray-100">
                                            {{ $movement->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-5 py-6 text-sm text-gray-500 dark:text-gray-300">
                            Aún no hay movimientos registrados.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
