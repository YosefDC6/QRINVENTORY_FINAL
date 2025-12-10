<x-guest-layout>
    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-4">
        <div
            class="w-full max-w-lg bg-slate-900/80 border border-slate-700 rounded-2xl shadow-2xl
                   backdrop-blur-sm p-8 space-y-6 text-slate-100"
        >

        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logo-qr.png') }}" class="h-16 w-auto" alt="QRInventory">
        </div>
            <div class="text-center space-y-1">
                <p class="text-xs uppercase tracking-[0.25em] text-indigo-400 font-semibold">
                    Crear cuenta
                </p>
                <h1 class="text-2xl font-bold">
                    Regístrate en <span class="text-indigo-400">QRInventory</span>
                </h1>
                <p class="text-sm text-slate-400">
                    Configura un usuario como empleado para comenzar a usar el sistema.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <label for="name" class="block text-sm font-medium text-slate-200">
                        Nombre
                    </label>
                    <input id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           class="block w-full rounded-lg border border-slate-700 bg-slate-950/60
                                  px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label for="email" class="block text-sm font-medium text-slate-200">
                        Email
                    </label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="block w-full rounded-lg border border-slate-700 bg-slate-950/60
                                  px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-sm font-medium text-slate-200">
                        Password
                    </label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           class="block w-full rounded-lg border border-slate-700 bg-slate-950/60
                                  px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-200">
                        Confirmar Password
                    </label>
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           required
                           class="block w-full rounded-lg border border-slate-700 bg-slate-950/60
                                  px-3 py-2.5 text-sm text-slate-100 placeholder-slate-500
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg
                                   bg-indigo-600 px-4 py-2.5 text-sm font-semibold tracking-wide
                                   text-white shadow-lg shadow-indigo-600/30
                                   hover:bg-indigo-700 focus:outline-none focus:ring-2
                                   focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-slate-900">
                        Registrarme
                    </button>
                </div>
            </form>

            <p class="text-center text-xs text-slate-400">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}"
                   class="text-indigo-400 hover:text-indigo-300 hover:underline font-medium">
                    Iniciar sesión
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
