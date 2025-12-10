<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nueva categoría
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Nombre
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border rounded-md p-2 text-sm
                               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
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
                        <a href="{{ route('categories.index') }}"
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
