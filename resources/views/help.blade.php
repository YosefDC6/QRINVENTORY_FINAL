<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Centro de Ayuda – QRInventory
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-8 space-y-8">

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        ¿Qué es QRInventory?
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        QRInventory es un sistema diseñado para que pequeñas tiendas puedan llevar un control sencillo 
                        y rápido de su inventario utilizando códigos QR. Cada producto genera un código QR único que 
                        permite registrar entradas y salidas de forma automática.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Roles dentro del sistema
                    </h3>

                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">

                        <div>
                            <h4 class="font-semibold text-indigo-600 dark:text-indigo-400">Administrador</h4>
                            <ul class="list-disc ml-6 mt-1">
                                <li>Registrar nuevos productos.</li>
                                <li>Generar códigos QR.</li>
                                <li>Modificar o eliminar productos.</li>
                                <li>Registrar categorías.</li>
                                <li>Dar de alta empleados y otros administradores.</li>
                                <li>Consultar reportes detallados de movimientos.</li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-semibold text-indigo-600 dark:text-indigo-400">Empleado</h4>
                            <ul class="list-disc ml-6 mt-1">
                                <li>Consultar el catálogo de productos.</li>
                                <li>Ver códigos QR y detalles de productos.</li>
                                <li>Registrar entradas y salidas escaneando códigos QR.</li>
                                <li>Consultar movimientos registrados.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        ¿Cómo registrar productos?
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        En el menú superior ingresa a <b>Productos</b> y selecciona <b>Agregar producto</b>. 
                        Llena los datos solicitados y el sistema generará automáticamente un código QR que 
                        podrás descargar o imprimir para pegarlo en el producto.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        ¿Cómo usar el escáner QR?
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        En el menú selecciona <b>Escáner QR</b>. Puedes escanear el código desde la cámara del 
                        dispositivo o introducir manualmente el SKU.  
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                        Después de escanear, el sistema mostrará el producto y te permitirá registrar si se trata de:
                    </p>

                    <ul class="list-disc ml-6 mt-2 text-sm">
                        <li><b>Entrada:</b> aumenta el inventario.</li>
                        <li><b>Salida:</b> reduce el inventario.</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Reportes de inventario
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        En la sección <b>Reportes</b> puedes consultar todos los movimientos filtrando por fecha, 
                        producto, tipo de movimiento y usuario.  
                        Además, puedes descargar los reportes en <b>Excel</b> o <b>PDF</b>.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Consejos de uso
                    </h3>
                    <ul class="list-disc ml-6 text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li>Actualiza los productos antes de imprimir nuevos códigos QR.</li>
                        <li>Evita registrar salidas mayores a la existencia.</li>
                        <li>Utiliza el escáner QR para agilizar el registro de entradas y salidas.</li>
                        <li>Revisa el reporte semanal para mantener control del inventario.</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Información adicional
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        Para dudas o soporte del sistema, comunícate con el administrador del sistema o 
                        con el equipo encargado del proyecto QRInventory.
                    </p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
