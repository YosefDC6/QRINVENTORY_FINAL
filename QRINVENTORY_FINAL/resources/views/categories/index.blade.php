<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Categorías
            </h2>
            <a href="{{ route('categories.create') }}"
               class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                Nueva categoría
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Descripción</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                    @forelse ($categories as $category)
                        <tr class="border-t border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                {{ $category->description }}
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Editar
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Eliminar esta categoría?');">
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
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
