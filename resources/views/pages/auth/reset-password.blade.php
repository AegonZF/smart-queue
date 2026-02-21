<x-layouts::auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    <div class="fixed inset-0 flex flex-col items-center justify-center bg-[#041C32] z-50 font-['Source_Sans_3']">
        
        {{-- LOGO --}}
        <div class="mb-10 text-center flex flex-col items-center">
            <img 
                src="{{ asset('images/Logo_1.svg') }}" 
                alt="Logo NovaBank" 
                class="w-[220px] h-auto object-contain"
            >
        </div>

        {{-- TARJETA PRINCIPAL --}}
        <div class="w-full max-w-[440px] min-h-[540px] flex flex-col justify-between bg-[#061421] px-10 py-12 rounded-[1.5rem] shadow-2xl">
            
            <div class="w-full">
                <h2 class="text-white text-center text-[1.15rem] font-normal mb-8 tracking-wide">
                    Nueva contraseña
                </h2>

                <form method="POST" action="{{ route('password.update') }}" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') ?? 'test-token' }}">
                    <input type="hidden" name="email" value="{{ $request->email ?? 'test@correo.com' }}">
                    
                    {{-- Nueva Contraseña --}}
                    <div class="mb-5">
                        <label class="block text-gray-300 text-[13px] mb-2" for="password">Ingresa nueva contraseña</label>
                        <input 
                            id="password"
                            type="password" 
                            name="password"
                            placeholder="Al menos 10 caracteres"
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-4 focus:ring-2 focus:ring-[#00705A] placeholder-gray-400 outline-none text-sm transition-all"
                        >
                        
                        {{-- ERROR DINÁMICO 1: Solo sale si la validación de 'password' falla --}}
                        @error('password')
                            <span class="font-['Roboto'] text-[#ef4444] text-[12px] mt-2 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Confirmar Contraseña --}}
                    <div class="mb-6">
                        <label class="block text-gray-300 text-[13px] mb-2" for="password_confirmation">Confirmar contraseña</label>
                        <input 
                            id="password_confirmation"
                            type="password" 
                            name="password_confirmation"
                            placeholder="Al menos 10 caracteres"
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-4 focus:ring-2 focus:ring-[#00705A] placeholder-gray-400 outline-none text-sm transition-all"
                        >
                    </div>

                    {{-- ERROR DINÁMICO 2: Solo sale si las contraseñas no coinciden --}}
                    <div class="mb-3">
                        @if($errors->has('password_confirmation') || $errors->has('password'))
                            <span class="font-['Roboto'] text-[#ef4444] text-[12px] block font-medium">
                                Contraseñas no coinciden
                            </span>
                        @endif
                    </div>

                    {{-- Botón Enviar Código --}}
                    <button type="submit" class="w-full bg-[#00705A] hover:bg-[#005B49] text-white font-medium py-3 rounded-full transition duration-200 text-sm">
                        Enviar código
                    </button>
                </form>
            </div>

            {{-- Enlace Inferior --}}
            <div class="mt-auto text-center pt-6">
                <flux:link href="{{ route('login') }}" class="text-[#94A3B8] text-[12px] hover:text-white transition-colors decoration-none">
                    Regresar a inicio de sesión
                </flux:link>
            </div>
        </div>
    </div>
</x-layouts::auth>