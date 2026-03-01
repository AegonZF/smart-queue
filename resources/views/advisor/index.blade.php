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
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]"
              x-data="{
                nextTurnNumber: @js($nextTurn?->turn_number),
                waitingCount: @js($waitingCount),
                counterLabel: @js($nextTurn?->serviceCounter?->label),
                tramite: @js($nextTurn?->tramite),
                userArea: @js($userArea),
                startTime: @js(optional($nextTurn?->created_at)->toIso8601String()),
                elapsedText: '00:00',
                csrf: document.querySelector('meta[name=csrf-token]')?.content,
                submitting: false,
                tick() {
                    if (!this.startTime || !this.nextTurnNumber) {
                        this.elapsedText = '00:00';
                        return;
                    }
                    const diff = Math.max(0, (Date.now() - new Date(this.startTime).getTime()) / 1000);
                    const m = Math.floor(diff / 60).toString().padStart(2, '0');
                    const s = Math.floor(diff % 60).toString().padStart(2, '0');
                    this.elapsedText = `${m}:${s}`;
                },
                poll() {
                    fetch('{{ route('advisor.status') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.json())
                        .then(d => {
                            if (!d.has_next) {
                                this.nextTurnNumber = null;
                                this.waitingCount = 0;
                                this.counterLabel = null;
                                this.tramite = null;
                                this.startTime = null;
                            } else {
                                const changed = this.nextTurnNumber !== d.turn_number;
                                this.nextTurnNumber = d.turn_number;
                                this.waitingCount = d.waiting_count;
                                this.counterLabel = d.counter_label;
                                this.tramite = d.tramite;
                                this.userArea = d.user_area ?? this.userArea;
                                if (changed) {
                                    this.startTime = d.created_at;
                                }
                            }
                        })
                        .catch(() => {});
                },
                submitNext() {
                    if (this.submitting) return;
                    this.submitting = true;
                    fetch('{{ route('advisor.turn.next') }}', {
                        method: 'POST',
                        headers: {'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': this.csrf}
                    }).then(() => { this.poll(); })
                      .finally(() => { this.submitting = false; });
                },
                submitExpire() {
                    if (this.submitting) return;
                    this.submitting = true;
                    fetch('{{ route('advisor.turn.expire') }}', {
                        method: 'POST',
                        headers: {'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': this.csrf}
                    }).then(() => { this.poll(); })
                      .finally(() => { this.submitting = false; });
                }
              }"
              x-init="setInterval(() => { poll(); }, 3000); setInterval(() => { tick(); }, 1000);">

            {{-- Mensajes de estado --}}
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-400 text-green-100 px-6 py-3 rounded-xl mb-6 max-w-2xl w-full text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/20 border border-red-400 text-red-100 px-6 py-3 rounded-xl mb-6 max-w-2xl w-full text-center">
                    {{ session('error') }}
                </div>
            @endif
            
            {{-- Indicadores Superiores --}}
            <div class="flex flex-col md:flex-row justify-center w-full max-w-5xl mb-12 gap-12 md:gap-32">
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Área asignada: <span class="font-normal opacity-90" x-text="userArea ?? 'Sin asignar'"></span>
                    </h2>
                </div>
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Clientes por Atender: <span class="font-normal opacity-90" x-text="waitingCount ?? 0"></span>
                    </h2>
                </div>
                
            </div>

            {{-- Tiempo transcurrido (ocupando el lugar anterior del área asignada) --}}
            <div class="mb-6 text-center">
                <p class="text-md md:text-lg font-semibold tracking-wide">
                    Tiempo transcurrido: <span class="font-bold text-blue-200" x-text="elapsedText"></span>
                </p>
            </div>
            <template x-if="nextTurnNumber">
            {{-- (Se quitó el detalle de “Ventanilla — Trámite” para no mostrarlo al iniciar) --}}
            {{-- Botones de Acción --}}
            <div class="flex flex-col md:flex-row gap-8 w-full max-w-4xl justify-center mb-20">
                {{-- Botón Siguiente (Verde) --}}
                <button type="button" @click="submitNext()" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#018d6c] disabled:opacity-50" :disabled="!nextTurnNumber">
                    <span class="text-2xl font-bold leading-tight text-white">
                    <span class="text-2xl font-bold leading-tight text-white">
                        Siguiente <br> Turno
                    </span>
                </button>

                {{-- Botón Expirado (Rojo) --}}
                <button type="button" @click="submitExpire()" class="bg-[#d3111b] hover:bg-[#b00e16] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#a30d15] disabled:opacity-50" :disabled="!nextTurnNumber">
                    <span class="text-2xl font-bold leading-tight text-white">
                        Turno <br> Expirado
                    </span>
                </button>
            </div>

        </main>
    </div>
</x-nova>
