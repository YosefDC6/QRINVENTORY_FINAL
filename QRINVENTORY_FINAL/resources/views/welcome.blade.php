<x-guest-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col">

        <header class="w-full border-b border-slate-800/60 bg-slate-950/60 backdrop-blur">
            
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">

        <a href="{{ route('welcome') }}" class="flex items-center gap-3">
  
            <img
                src="{{ asset('images/logo-qr.png') }}"
                alt="QRInventory"
                class="h-10 w-auto object-contain"
            >

            <div class="flex flex-col leading-tight">
                <span class="font-semibold text-white text-sm md:text-base">
                    QRInventory
                </span>
                <span class="text-xs text-slate-400">
                    Control de inventario con códigos QR
                </span>
            </div>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-lg border border-slate-700 text-xs md:text-sm
                      text-slate-200 hover:bg-slate-800 transition">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
               class="px-4 py-2 rounded-lg bg-indigo-500 text-xs md:text-sm
                      text-white font-semibold hover:bg-indigo-400 transition">
                Registrarse
            </a>
        </div>
    </div>
</header>

        <main class="flex-1">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 lg:gap-16 items-center">

                    <div class="space-y-6">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-gray-100 leading-tight">
                            Controla tu inventario
                            <span class="text-indigo-600 block">escaneando códigos QR.</span>
                        </h1>

                        <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed max-w-xl">
                            QRInventory está pensado para tiendas pequeñas que necesitan una forma sencilla
                            y confiable de llevar el control de sus productos. Cada artículo genera un código
                            QR único que permite registrar entradas y salidas en segundos.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm max-w-xl">
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-6 w-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                                    1
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        Registra tus productos
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 text-xs">
                                        Nombre, categoría, precio, stock y un código QR generado automáticamente.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-6 w-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                                    2
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        Escanea y actualiza
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 text-xs">
                                        Escanea el QR para registrar entradas o salidas y actualizar el inventario.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-6 w-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                                    3
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        Control por roles
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 text-xs">
                                        Administradores configuran el sistema; empleados registran movimientos.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-6 w-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                                    4
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        Reportes claros
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 text-xs">
                                        Consulta entradas, salidas y productos con stock bajo, exportando a Excel o PDF.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3 pt-2">
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-5 py-2.5 rounded-md bg-indigo-600 text-white
                                      text-sm font-semibold shadow hover:bg-indigo-700">
                                Comenzar ahora
                            </a>
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center px-4 py-2.5 rounded-md border border-gray-300
                                      dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200
                                      bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800">
                                Ya tengo una cuenta
                            </a>
                        </div>
                    </div>

                    <div class="flex justify-center sm:justify-end">
                        <div class="w-full max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg p-6 space-y-4">
                            <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                                Vista rápida del sistema
                            </p>

                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-3 bg-gray-50 dark:bg-gray-900">
                                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-1">
                                        Módulos
                                    </p>
                                    <ul class="space-y-1 text-gray-800 dark:text-gray-100">
                                        <li>• Productos</li>
                                        <li>• Categorías</li>
                                        <li>• Movimientos</li>
                                        <li>• Reportes</li>
                                    </ul>
                                </div>
                                <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-3 bg-gray-50 dark:bg-gray-900">
                                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-1">
                                        Funciones clave
                                    </p>
                                    <ul class="space-y-1 text-gray-800 dark:text-gray-100">
                                        <li>• Códigos QR por producto</li>
                                        <li>• Entradas y salidas</li>
                                        <li>• Catálogo solo lectura</li>
                                        <li>• Control de roles</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="border border-dashed border-gray-300 dark:border-gray-700 rounded-xl p-4 bg-gray-50 dark:bg-gray-900">
                                <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">
                                    ¿Cómo se usa?
                                </p>
                                <ol class="list-decimal ml-4 space-y-1 text-xs text-gray-700 dark:text-gray-300">
                                    <li>Registra un producto desde el panel.</li>
                                    <li>Descarga e imprime su código QR.</li>
                                    <li>Pega el QR en el producto.</li>
                                    <li>Escanéalo para registrar ventas o entradas de stock.</li>
                                </ol>
                            </div>

                            <p class="text-[11px] text-gray-500 dark:text-gray-400">
                                Proyecto desarrollado como parte de la materia de Programación Web. Pensado para cubrir
                                las necesidades básicas de inventario de una tienda pequeña utilizando Laravel y códigos QR.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <footer class="border-t border-gray-200 dark:border-gray-800 py-4 text-center text-[11px] text-gray-500 dark:text-gray-400">
            QRInventory · Sistema de control de inventario con códigos QR
        </footer>
    </div>
</x-guest-layout>
