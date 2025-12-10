<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear usuario
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
                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Nombre
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                      dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Correo electrónico
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                      dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Rol
                        </label>
                        <select name="role"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                       dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}" @selected(old('role') === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                                Contraseña
                            </label>
                            <input type="password" name="password"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                          dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                                Confirmar contraseña
                            </label>
                            <input type="password" name="password_confirmation"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                          dark:text-gray-100 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('users.index') }}"
                           class="inline-flex items-center px-3 py-2 rounded-md border text-xs font-medium
                                  border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200
                                  bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold tracking-wide
                                       text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                                       focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
