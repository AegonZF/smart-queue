<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- Header alineado --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div class="flex items-center">
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[180px] h-auto">
            </div>

            <x-user-dropdown />
        </header>

        {{-- Notificaciones slide-in (estilo toast, debajo del icono de perfil) --}}
        @if(request()->boolean('expired'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="fixed top-24 right-8 z-[100] flex items-center gap-4 bg-[#072b4e] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/5 max-w-sm"
            >
                <span class="flex-shrink-0 bg-[#0f1c2e] rounded-xl p-2">
                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                    </svg>
                </span>
                <span class="font-bold text-base leading-snug">Su turno ha expirado!</span>
            </div>
        @endif

        @if(request()->boolean('cancelled'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="fixed top-24 right-8 z-[100] flex items-center gap-4 bg-[#072b4e] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/5 max-w-sm"
            >
                <span class="flex-shrink-0 bg-[#0f1c2e] rounded-xl p-2">
                    <svg class="w-8 h-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
                <span class="font-bold text-base leading-snug">Su turno ha sido cancelado</span>
            </div>
        @endif

        @if(session('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="fixed top-24 right-8 z-[100] flex items-center gap-4 bg-[#072b4e] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/5 max-w-sm"
            >
                <span class="flex-shrink-0 bg-[#0f1c2e] rounded-xl p-2">
                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </span>
                <span class="font-bold text-base leading-snug">{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="fixed top-24 right-8 z-[100] flex items-center gap-4 bg-[#072b4e] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/5 max-w-sm"
            >
                <span class="flex-shrink-0 bg-[#0f1c2e] rounded-xl p-2">
                    <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </span>
                <span class="font-bold text-base leading-snug">{{ session('success') }}</span>
            </div>
        @endif

        <main class="flex flex-col items-center justify-center mt-6 px-6 w-full">

                {{-- Título con espaciado amplio igual que el diseño --}}
                <h1 class="text-[28px] md:text-[36px] font-bold tracking-[0.25em] text-center uppercase mb-20 drop-shadow-md">
                    TRÁMITE A REALIZAR
                </h1>

                <div class="flex flex-col md:flex-row gap-12 w-full max-w-5xl justify-center mb-10">
                    {{-- Botón: Acudir a Ventanilla --}}
                    <a href="{{ route('nova.ventanilla.tramite') }}" 
                       class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2.5rem] p-10 w-full md:w-[320px] h-56 flex items-center justify-center text-center shadow-2xl border border-white/10 group">
                        <span class="text-2xl font-bold leading-tight text-white group-hover:drop-shadow-lg">Acudir a <br> ventanilla</span>
                    </a>

                    {{-- Botón: Hablar con Asesor --}}
                    <a href="{{ route('nova.asesor.generar') }}" 
                       class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2.5rem] p-10 w-full md:w-[320px] h-56 flex items-center justify-center text-center shadow-2xl border border-white/10 group">
                        <span class="text-2xl font-bold leading-tight text-white group-hover:drop-shadow-lg">Hablar con <br> un Asesor</span>
                    </a>
                </div>
        </main>
    </div>
</x-nova>
