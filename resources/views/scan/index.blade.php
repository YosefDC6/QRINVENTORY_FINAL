<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Escaneo de producto · Movimiento de inventario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 border border-green-300 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 px-4 py-3 text-sm text-red-800">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">
                    Buscar producto por SKU
                </h3>

                <form method="POST" action="{{ route('scan.process') }}" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input
                        type="text"
                        name="sku"
                        placeholder="Escanea o escribe el SKU aquí"
                        class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                               dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('sku') }}"
                    >
                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-md text-xs font-semibold
                                   tracking-wide text-white bg-indigo-600 hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Buscar
                    </button>
                </form>
            </div>

            @isset($product)
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $product->name }}
                        </h3>

                        <p class="mt-1 text-sm text-gray-400">
                            SKU: <span class="font-mono">{{ $product->sku }}</span>
                            @if($product->category)
                                · Categoría: {{ $product->category->name }}
                            @endif
                        </p>

                        <p class="mt-2 text-sm text-gray-300">
                            Precio: <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
                            · Stock actual:
                            <span class="font-semibold {{ $product->quantity <= $product->min_stock ? 'text-red-400' : 'text-green-400' }}">
                                {{ $product->quantity }}
                            </span>
                            @if(!is_null($product->min_stock))
                                · Stock mínimo: {{ $product->min_stock }}
                            @endif
                        </p>
                    </div>

                    @auth
                        <form method="POST" action="{{ route('movements.store') }}" class="space-y-5">
                            @csrf

                            {{-- Datos ocultos --}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="from_scan" value="1">

                            <div>
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                    Tipo de movimiento
                                </h4>

                                <div class="flex flex-wrap gap-4">
                                    <label class="inline-flex items-center gap-2 text-sm text-gray-800 dark:text-gray-100">
                                        <input type="radio" name="movement_type" value="entrada" checked
                                               class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                                        Entrada (aumentar stock)
                                    </label>

                                    <label class="inline-flex items-center gap-2 text-sm text-gray-800 dark:text-gray-100">
                                        <input type="radio" name="movement_type" value="salida"
                                               class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                                        Salida (disminuir stock)
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                                    Cantidad
                                </label>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    value="1"
                                    class="w-32 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                           dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                <p class="mt-1 text-xs text-gray-400">
                                    Ingresa cuántas unidades entran o salen del inventario.
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                                    Nota (opcional)
                                </label>
                                <input
                                    type="text"
                                    name="note"
                                    value="{{ old('note') }}"
                                    placeholder="Ejemplo: Reposición, venta mostrador, ajuste, etc."
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                           dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('products.index') }}"
                                   class="inline-flex items-center px-3 py-2 rounded-md border text-xs font-medium
                                          border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200
                                          bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    Volver al listado de productos
                                </a>

                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold
                                               tracking-wide text-white bg-indigo-600 hover:bg-indigo-700
                                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Guardar movimiento
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-red-400">
                            Debes iniciar sesión para registrar movimientos de inventario.
                        </p>
                    @endauth

                </div>
            @else
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <p class="text-sm text-gray-700 dark:text-gray-200">
                        Escanea un código QR válido o escribe un SKU en el formulario de arriba.
                    </p>
                    <p class="mt-2 text-xs text-gray-400">
                        Cuando se encuentre un producto, aquí se mostrará su información y podrás registrar entradas o salidas.
                    </p>
                </div>
            @endisset

        </div>
    </div>
</x-app-layout>
