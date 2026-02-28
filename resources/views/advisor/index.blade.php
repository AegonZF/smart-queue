<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal: Azul #0C4D8B --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER CON COMPONENTE MODULAR --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Llamada al componente reutilizable --}}
            <x-user-dropdown />
        </header>

        {{-- CONTENIDO DEL ASESOR --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">
            
            {{-- Indicadores Superiores --}}
            <div class="flex flex-col md:flex-row justify-center w-full max-w-5xl mb-12 gap-12 md:gap-32">
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Ventanilla Asignada: <span class="font-normal opacity-90">1</span>
                    </h2>
                </div>
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Clientes por Atender: <span class="font-normal opacity-90">1</span>
                    </h2>
                </div>
            </div>

            {{-- Tiempo del turno --}}
            <div class="mb-16 text-center">
                <p class="text-lg md:text-xl font-medium tracking-wide">
                    Tiempo del turno actual : <span class="font-bold text-blue-200">15 Minutos</span>
                </p>
            </div>

            {{-- Botones de Acción con efecto 3D --}}
            <div class="flex flex-col md:flex-row gap-8 w-full max-w-4xl justify-center mb-20">
                {{-- Botón Siguiente (Verde) --}}
                <button class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#018d6c]">
                    <span class="text-2xl font-bold leading-tight text-white">
                        Siguiente <br> Turno
                    </span>
                </button>

                {{-- Botón Expirado (Rojo) --}}
                <button class="bg-[#d3111b] hover:bg-[#b00e16] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#a30d15]">
                    <span class="text-2xl font-bold leading-tight text-white">
                        Turno <br> Expirado
                    </span>
                </button>
            </div>

        </main>
    </div>
</x-nova>