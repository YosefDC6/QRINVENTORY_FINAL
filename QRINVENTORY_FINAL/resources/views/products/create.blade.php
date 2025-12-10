<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuevo producto
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('products.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Categoría
                        </label>
                        <select name="category_id"
                                class="mt-1 block w-full border rounded-md p-2 text-sm
                                       dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                            <option value="">-- Selecciona una categoría --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Nombre del producto
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border rounded-md p-2 text-sm
                               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Precio
                            </label>
                            <input type="number" step="0.01" min="0" name="price"
                                   value="{{ old('price', 0) }}"
                                   class="mt-1 block w-full border rounded-md p-2 text-sm
                                   dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Stock inicial
                            </label>
                            <input type="number" min="0" name="stock"
                                   value="{{ old('stock', 0) }}"
                                   class="mt-1 block w-full border rounded-md p-2 text-sm
                                   dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Stock mínimo
                            </label>
                            <input type="number" min="0" name="min_stock"
                                   value="{{ old('min_stock') }}"
                                   class="mt-1 block w-full border rounded-md p-2 text-sm
                                   dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Descripción
                        </label>
                        <textarea name="description" rows="3"
                                  class="mt-1 block w-full border rounded-md p-2 text-sm
                                  dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}"
                           class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 dark:text-gray-100 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
