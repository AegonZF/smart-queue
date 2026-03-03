<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal con fondo azul sólido --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50"
         x-data="{
             estimatedWait: 0,
             isNext: false,
             notified: false,
             showNotification: false,
             delayNotified: false,
             showDelayNotification: false,
             counterLabel: @js($turn->serviceCounter->identifier),
             poll() {
                 fetch('{{ route('nova.turno.active') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                     .then(r => r.json())
                     .then(d => {
                         if (!d.has_turn) {
                             const q = d.last_status === 'expired' ? 'expired=1' : (d.last_status === 'cancelled' ? 'cancelled=1' : '');
                             window.location.href = '{{ route('nova.index') }}' + (q ? ('?' + q) : '');
                             return;
                         }
                         if (d.status === 'expired' || d.status === 'cancelled') {
                             const q = d.status === 'expired' ? 'expired=1' : 'cancelled=1';
                             window.location.href = '{{ route('nova.index') }}?' + q;
                             return;
                         }
                         this.estimatedWait = d.estimated_wait ?? 0;
                         if (this.estimatedWait > 15 && !this.delayNotified) {
                             this.delayNotified = true;
                             this.showDelayNotification = true;
                             setTimeout(() => this.showDelayNotification = false, 8000);
                         }
                         if (d.is_next && !this.notified) {
                             this.notified = true;
                             this.showNotification = true;
                             this.counterLabel = d.counter_identifier ?? this.counterLabel;
                             setTimeout(() => this.showNotification = false, 6000);
                         }
                     })
                     .catch(() => {});
             }
         }"
         x-init="poll(); setInterval(() => poll(), 3000)">
        
        {{-- Notificación: Retraso --}}
        <div
            x-show="showDelayNotification"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-44 right-8 z-[100] flex items-center gap-4 bg-[#4a1f00] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/10 max-w-sm"
        >
            <span class="flex-shrink-0 bg-[#2e1200] rounded-xl p-2">
                <svg class="w-8 h-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </span>
            <span class="font-bold text-base leading-snug">¡Estamos experimentando retrasos!</span>
        </div>

        {{-- Notificación: Es su turno --}}
        <div
            x-show="showNotification"
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <span class="font-bold text-base leading-snug" x-text="'Es su turno, pasa a Ventanilla ' + counterLabel"></span>
        </div>

        {{-- HEADER: Logo e Inclusión del Componente --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Llamada al componente reutilizable --}}
            <x-user-dropdown />
        </header>

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">
            
            <div class="flex flex-col md:flex-row justify-between w-full max-w-5xl mb-16 gap-8">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-bold tracking-[0.1em] uppercase">
                        Ventanilla Asignada: <span class="font-normal opacity-90">{{ $turn->serviceCounter->identifier }}</span>
                    </h2>
                </div>
                <div class="text-center md:text-right">
                    <h2 class="text-2xl md:text-3xl font-bold tracking-[0.1em] uppercase">
                        Turno Generado: <span class="font-normal opacity-90">{{ $turn->turn_number }}</span>
                    </h2>
                </div>
            </div>

            {{-- Tiempo de espera aproximado --}}
            <div class="mb-12 text-center">
                <p class="text-xl md:text-2xl font-semibold italic">
                    Tiempo de espera aproximado : <span class="font-normal" x-text="estimatedWait"></span> min
                </p>
            </div>

            <div class="flex justify-center mb-20">
                {{-- Botón Cancelar (Rojo) --}}
                <form method="GET" action="{{ route('nova.turno.cancel') }}">
                    <button type="submit" class="bg-[#d3111b] hover:bg-[#b00e16] transition-all duration-200 rounded-[2rem] p-8 w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border border-white/5">
                        <span class="text-2xl font-bold leading-tight text-white">
                            Cancelar <br> Turno
                        </span>
                    </button>
                </form>
            </div>

        </main>
    </div>
</x-nova>
