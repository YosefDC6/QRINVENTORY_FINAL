<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Productos
            </h2>
            <a href="{{ route('products.create') }}"
               class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                Nuevo producto
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Categoría</th>
                            <th class="px-4 py-2 text-right">Precio</th>
                            <th class="px-4 py-2 text-right">Stock</th>
                            <th class="px-4 py-2 text-center">QR</th>
                            <th class="px-4 py-2 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @forelse ($products as $product)
                            <tr class="border-t border-gray-200 dark:border-gray-700">
                                <td class="px-4 py-2">
                                    <div class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $product->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        SKU: {{ $product->sku }}
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    {{ $product->category?->name ?? 'Sin categoría' }}
                                </td>
                                <td class="px-4 py-2 text-right">
                                    ${{ number_format($product->price, 2) }}
                                </td>
                                <td class="px-4 py-2 text-right">
                                    {{ $product->quantity }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                   @if ($product->qr_code)
                                         <img src="{{ asset('storage/'.$product->qr_code) }}"
                                        alt="QR {{ $product->sku }}"
                                        class="inline-block h-12 w-12">
                                        @else
                                        <span class="text-xs text-gray-400">Sin QR</span>
                                        @endif


                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Editar
                                    </a>

                                    @if ($product->qr_code)
                                        <a href="{{ route('products.qr', $product) }}"
                                           class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                            Descargar QR
                                        </a>
                                    @endif

                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
