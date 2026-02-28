<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    
    <body class="min-h-screen bg-[#001d3d] antialiased">
        
        <div class="bg-[#001d3d] flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-4 mb-6" wire:navigate>
                    <div class="flex items-center justify-center">
                        <x-app-logo-icon class="h-20 w-auto" />
                    </div>
                    
                    <span class="text-white font-bold text-3xl tracking-tight"></span>
                </a>

                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>