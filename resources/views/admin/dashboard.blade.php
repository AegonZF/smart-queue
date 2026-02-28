<x-layouts::auth>
    <style>
        /* Importación corregida con ambas tipografías */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal ajustado al 100% de la pantalla con scroll libre --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER: Logo a la izquierda, Icono de Usuario a la derecha --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Icono de Usuario Circular con Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="w-[50px] h-[50px] bg-[#3B82F6] rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-blue-600 transition-colors focus:outline-none">
                    <svg class="w-8 h-8 text-white mt-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-3 w-48 bg-[#072b4e] rounded-xl shadow-2xl border border-white/10 overflow-hidden z-50" style="display: none;">
                    
                    {{-- Nombre del usuario --}}
                    <div class="px-4 py-3 border-b border-white/10">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-gray-400 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>

                    {{-- Cerrar sesión --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
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
                @if($ventanillas->count() > 0)
                    @foreach($ventanillas as $ventanilla)
                        <div class="bg-[#02B48A] rounded-[1.5rem] p-8 flex flex-col items-center justify-center min-h-[170px] shadow-lg border border-white/5">
                            <h2 class="font-bold text-[18px] mb-2 text-white">{{ $ventanilla->label }}</h2>
                            <p class="text-[15px] mb-6 text-white/90">Operador:
                                @php
                                    $operador = \App\Models\User::where('area_designada', $ventanilla->label)->first();
                                @endphp
                                <span class="font-bold">{{ $operador ? $operador->name : 'Sin asignar' }}</span>
                            </p>
                            <p class="text-[15px] text-white/90">Turnos totales:</p>
                        </div>
                    @endforeach
                @else
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-[#02B48A] rounded-[1.5rem] p-8 flex flex-col items-center justify-center min-h-[170px] shadow-lg border border-white/5">
                            <h2 class="font-bold text-[18px] mb-2 text-white">Ventanilla {{ $i }}</h2>
                            <p class="text-[15px] mb-6 text-white/90">Operador:</p>
                            <p class="text-[15px] text-white/90">Turnos totales:</p>
                        </div>
                    @endfor
                @endif
            </div>

            {{-- Grid de Asesores --}}
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;" class="w-full max-w-[1000px] mb-12">
                @if($asesores->count() > 0)
                    @foreach($asesores as $asesor)
                        <div class="bg-[#02B48A] rounded-[1.5rem] p-8 flex flex-col items-center justify-center min-h-[170px] shadow-lg border border-white/5">
                            <h2 class="font-bold text-[18px] mb-2 text-white">{{ $asesor->label }}</h2>
                            <p class="text-[15px] mb-6 text-white/90">Operador:
                                @php
                                    $operador = \App\Models\User::where('area_designada', $asesor->label)->first();
                                @endphp
                                <span class="font-bold">{{ $operador ? $operador->name : 'Sin asignar' }}</span>
                            </p>
                            <p class="text-[15px] text-white/90">Turnos totales:</p>
                        </div>
                    @endforeach
                @else
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="bg-[#02B48A] rounded-[1.5rem] p-8 flex flex-col items-center justify-center min-h-[170px] shadow-lg border border-white/5">
                            <h2 class="font-bold text-[18px] mb-2 text-white">Asesor {{ $i }}</h2>
                            <p class="text-[15px] mb-6 text-white/90">Operador:</p>
                            <p class="text-[15px] text-white/90">Turnos totales:</p>
                        </div>
                    @endfor
                @endif
            </div>

            {{-- Botones de Acción --}}
            <div class="flex flex-col md:flex-row gap-8 w-full max-w-[800px] justify-center mb-24">
                
                {{-- Botón Encender/Apagar Generación de Turnos --}}
                <form method="POST" action="{{ route('admin.turns.toggle') }}">
                    @csrf
                    @if($isActive)
                        <button type="submit" class="bg-[#CC0000] hover:bg-[#A30000] text-white px-10 py-5 rounded-2xl font-bold text-[18px] transition-all active:scale-95 shadow-xl text-center leading-tight min-w-[280px]"
                                onclick="return confirm('¿Estás seguro? Esto cancelará todos los turnos activos y reseteará los contadores.')">
                            Apagar Generación <br> de Turnos
                        </button>
                    @else
                            <button type="submit" class="bg-[#02B48A] hover:bg-[#029A73] text-white px-10 py-5 rounded-2xl font-bold text-[18px] transition-all active:scale-95 shadow-xl flex items-center justify-center min-w-[280px] text-center">
                            Encender Generación <br> de Turnos
                        </button>
                    @endif
                </form>
                
                {{-- Botón Dar Alta --}}
                <a href="/admin/registro-empleado" class="bg-[#02B48A] hover:bg-[#029A73] text-white px-10 py-5 rounded-2xl font-bold text-[18px] transition-all active:scale-95 shadow-xl flex items-center justify-center min-w-[280px] text-center">
                    Gestionar <br> Empleados
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