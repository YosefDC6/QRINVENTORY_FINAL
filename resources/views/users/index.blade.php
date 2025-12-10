<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Administración de usuarios
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 border border-green-300 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="px-4 py-4 sm:px-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Usuarios del sistema
                    </h3>
                    <a href="{{ route('users.create') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold tracking-wide
                              text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                              focus:ring-offset-2 focus:ring-indigo-500">
                        + Nuevo usuario
                    </a>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700">
                    @if ($users->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Nombre</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Correo</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-300">Rol</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-600 dark:text-gray-300">Acciones</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-4 py-2 text-sm">
                                            @if ($user->role === 'admin')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-700">
                                                    Administrador
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                                    Empleado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-right text-xs">
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="inline-flex items-center px-3 py-1 rounded-md bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                Editar
                                            </a>

                                            @if (auth()->id() !== $user->id)
                                                <form action="{{ route('users.destroy', $user) }}"
                                                      method="POST"
                                                      class="inline-block"
                                                      onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 rounded-md bg-red-100 text-red-700 hover:bg-red-200">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="px-4 py-6 text-sm text-gray-500 dark:text-gray-300">
                            No hay usuarios registrados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
