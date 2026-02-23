{{-- Script de cierre de sesión por inactividad --}}
{{-- Solo se activa para usuarios autenticados --}}
@auth
<script>
    (function() {
        // Tiempo de inactividad en milisegundos (1 minuto para pruebas, cambiar a 30 * 60 * 1000 para producción)
        const INACTIVITY_TIMEOUT = 30 * 60 * 1000; // 30 minutos 

        let inactivityTimer;

        function resetTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(logoutByInactivity, INACTIVITY_TIMEOUT);
        }

        function logoutByInactivity() {
            // Crear form y enviar POST a logout por inactividad
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("logout.inactivity") }}';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            document.body.appendChild(form);
            form.submit();
        }

        // Eventos que indican actividad del usuario
        const activityEvents = [
            'mousedown', 'mousemove', 'keydown',
            'scroll', 'touchstart', 'click', 'wheel'
        ];

        activityEvents.forEach(function(event) {
            document.addEventListener(event, resetTimer, { passive: true });
        });

        // Iniciar el timer
        resetTimer();
    })();
</script>
@endauth
