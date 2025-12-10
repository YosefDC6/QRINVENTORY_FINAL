<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar movimiento de inventario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 px-4 py-3 text-sm text-red-800">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('movements.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Producto
                        </label>
                        <select name="product_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                       dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona un producto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                    {{ $product->name }} (SKU: {{ $product->sku }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Tipo de movimiento
                        </span>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center text-sm text-gray-800 dark:text-gray-100">
                                <input type="radio" name="movement_type" value="entrada"
                                       class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                                       {{ old('movement_type', 'entrada') === 'entrada' ? 'checked' : '' }}>
                                <span class="ml-2">Entrada (aumenta stock)</span>
                            </label>
                            <label class="inline-flex items-center text-sm text-gray-800 dark:text-gray-100">
                                <input type="radio" name="movement_type" value="salida"
                                       class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                                       {{ old('movement_type') === 'salida' ? 'checked' : '' }}>
                                <span class="ml-2">Salida (disminuye stock)</span>
                            </label>
                        </div>
                        @error('movement_type')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Cantidad
                        </label>
                        <input type="number" name="quantity" min="1"
                               value="{{ old('quantity', 1) }}"
                               class="w-32 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                      dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('quantity')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Nota (opcional)
                        </label>
                        <input type="text" name="note"
                               value="{{ old('note') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                      dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Ejemplo: venta mostrador, ajuste, devolución, etc.">
                        @error('note')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('movements.index') }}"
                           class="inline-flex items-center px-3 py-2 rounded-md border text-xs font-medium
                                  border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200
                                  bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold tracking-wide
                                       text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                                       focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar movimiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
