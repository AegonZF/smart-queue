<x-layouts::auth>
    <style>
        /* Importación corregida con ambas tipografías */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal ajustado al 100% de la pantalla con scroll libre --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#041C32] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER: Logo a la izquierda, Icono de Usuario a la derecha --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Icono de Usuario Circular --}}
            <div class="w-[50px] h-[50px] bg-[#3B82F6] rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-blue-600 transition-colors">
                <svg class="w-8 h-8 text-white mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
        </header>

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center mt-4 px-6 w-full">
            
            {{-- Título Principal --}}
            <h1 class="text-[26px] font-bold tracking-wider uppercase mb-12 text-center w-full">
                Panel Administrador
            </h1>

            {{-- Grid de Ventanillas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-[1000px] mb-12">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-[#00705A] rounded-[1.5rem] p-8 flex flex-col items-center justify-center min-h-[170px] shadow-lg border border-white/5">
                        <h2 class="font-bold text-[18px] mb-2 text-white">Ventanilla {{ $i }}</h2>
                        <p class="text-[15px] mb-6 text-white/90">Operador:</p>
                        <p class="text-[15px] text-white/90">Turnos totales:</p>
                    </div>
                @endfor
            </div>

            {{-- Botones de Acción --}}
            <div class="flex flex-col md:flex-row gap-8 w-full max-w-[800px] justify-center mb-24">
                
                {{-- Botón Apagar --}}
                <button class="bg-[#CC0000] hover:bg-[#A30000] text-white px-10 py-5 rounded-2xl font-bold text-[18px] transition-all active:scale-95 shadow-xl text-center leading-tight min-w-[280px]">
                    Apagar Generación <br> de Turnos
                </button>
                
                {{-- Botón Dar Alta (Actualizado a la nueva ruta de registro de empleados) --}}
                <a href="/admin/registro-empleado" class="bg-[#00705A] hover:bg-[#005B49] text-white px-10 py-5 rounded-2xl font-bold text-[18px] transition-all active:scale-95 shadow-xl flex items-center justify-center min-w-[280px] text-center">
                    Dar Alta Empleados
                </a>
            </div>

            {{-- Título Analíticas --}}
            <h1 class="text-[26px] font-bold tracking-wider uppercase mb-12 text-center w-full">
                Analíticas
            </h1>
            
            {{-- Aquí irá el contenido de las analíticas en el futuro --}}

        </main>
    </div>
</x-layouts::auth>