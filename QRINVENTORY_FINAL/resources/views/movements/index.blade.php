<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Historial de movimientos de inventario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 border border-green-300 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="px-4 py-4 sm:px-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Movimientos recientes
                    </h3>
                    <a href="{{ route('movements.create') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold tracking-wide
                              text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                              focus:ring-offset-2 focus:ring-indigo-500">
                        Registrar movimiento
                    </a>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700">
                    @if ($movements->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Fecha</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Producto</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Tipo</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-600 dark:text-gray-300">Cantidad</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Usuario</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Nota</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($movements as $movement)
                                    <tr>
                                        <td class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $movement->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                            {{ $movement->product->name ?? 'Producto eliminado' }}
                                            <div class="text-xs text-gray-400">
                                                SKU: {{ $movement->product->sku ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2">
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
                            Aún no hay movimientos registrados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
