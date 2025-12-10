<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catálogo de productos (solo lectura)
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Aquí puedes consultar los productos registrados, su SKU y el código QR asociado. 
                Esta vista es solo de lectura.
            </p>

            <div class="mb-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="GET" action="{{ route('catalog.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Buscar (nombre o SKU)
                        </label>
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                   dark:text-gray-100 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Ej: Coca, YGJ8PMTM...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Categoría
                        </label>
                        <select name="category_id"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                             dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                             <option value="">Todas</option>

                             @foreach ($categories as $category)
                               <option value="{{ $category->id }}"
                                    @selected($category_id == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Opciones
                        </label>
                        <label class="inline-flex items-center space-x-2 text-gray-800 dark:text-gray-200">
                            <input type="checkbox" name="low_stock" value="1"
                                class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500"
                                {{ $low_stock ? 'checked' : '' }}>
                            <span>Solo stock bajo</span>
                        </label>
                    </div>

                    <div class="flex gap-2 justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold hover:bg-indigo-700">
                            Aplicar filtros
                        </button>

                        <a href="{{ route('catalog.index') }}"
                            class="px-3 py-2 border text-xs rounded-md text-gray-700 dark:text-gray-200
                                   bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 hover:bg-gray-100">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($products as $p)
                    <div class="bg-gray-900 text-gray-200 p-6 rounded-xl shadow-xl border border-gray-700">
                        
                        <h3 class="text-lg font-bold mb-1">{{ $p->name }}</h3>

                        <p class="text-gray-400 text-sm">
                            Categoría: <span class="text-gray-300">{{ $p->category->name }}</span>
                        </p>

                        <p class="text-gray-400 text-sm">
                            SKU: <span class="font-mono text-gray-300">{{ $p->sku }}</span>
                        </p>

                        <p class="text-gray-400 text-sm mb-4">
                            Stock actual: <span class="text-gray-200">{{ $p->quantity }}</span>
                        </p>

                        <div class="border border-dashed border-gray-600 rounded-lg p-4 mb-4 flex justify-center">
                            <img src="{{ asset('storage/'.$p->qr_code) }}" alt="QR" class="w-40 h-40">
                        </div>

                        <a href="{{ route('products.qr', $p->id) }}"
                           class="px-4 py-2 rounded-md bg-indigo-700 hover:bg-indigo-800 text-white text-sm block text-center">
                           Descargar QR
                        </a>

                    </div>
                @endforeach

            </div>
            
            <div class="mt-6">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
