<div id="client-toasts" x-data="{
    toasts: [],
    add(type, message) {
        const id = Date.now() + Math.random();
        const iconBg = '#041f3a';
        const styles = {
            expired: { bg: 'bg-[#0B2C4A]', text: 'text-white', icon: 'expired' },
            cancelled: { bg: 'bg-[#0B2C4A]', text: 'text-white', icon: 'cancel' },
            service: { bg: 'bg-[#0B2C4A]', text: 'text-white', icon: 'service' },
            delay: { bg: 'bg-[#0B2C4A]', text: 'text-white', icon: 'delay' },
        };
        this.toasts.push({ id, type, message, style: styles[type] ?? styles.delay });
        setTimeout(() => this.remove(id), 5000);
    },
    remove(id) { this.toasts = this.toasts.filter(t => t.id !== id); }
}" x-init="
    if (window.__toastQueue && Array.isArray(window.__toastQueue)) {
        window.__toastQueue.forEach(t => add(t.type, t.message));
        window.__toastQueue = [];
    }
" class="fixed top-24 right-6 z-50 space-y-3 select-none">
    <template x-for="t in toasts" :key="t.id">
        <div :class="`flex items-center rounded-[1.5rem] px-4 py-3 shadow-xl border border-white/10 ${t.style.bg}`">
            <div class="w-10 h-10 mr-3 rounded-full flex items-center justify-center bg-[#0D2844]">
                <template x-if="t.style.icon === 'expired'">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke-width="2"></circle>
                        <path d="M12 7v6l4 2" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </template>
                <template x-if="t.style.icon === 'cancel'">
                    <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.3 5.71a1 1 0 0 0-1.41 0L12 10.59 7.11 5.7A1 1 0 0 0 5.7 7.11L10.59 12l-4.9 4.89a1 1 0 1 0 1.41 1.42L12 13.41l4.89 4.9a1 1 0 0 0 1.42-1.41L13.41 12l4.9-4.89a1 1 0 0 0-.01-1.4z"/>
                    </svg>
                </template>
                <template x-if="t.style.icon === 'service'">
                    <svg class="w-6 h-6 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm1 15h-2v-2h2v2Zm0-4h-2V7h2v6Z"/>
                    </svg>
                </template>
                <template x-if="t.style.icon === 'delay'">
                    <svg class="w-6 h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11 7h2v6h-2V7Zm0 8h2v2h-2v-2ZM1 21h22L12 2 1 21Z"/>
                    </svg>
                </template>
            </div>
            <div>
                <p class="text-sm font-semibold text-white" x-text="t.message"></p>
            </div>
        </div>
    </template>
    <script>
        (function() {
            const root = document.getElementById('client-toasts');
            window.__toastQueue = window.__toastQueue || [];
            window.pushToast = function(type, message) {
                if (root && root.__x) {
                    root.__x.$data.add(type, message);
                    return;
                }
                window.__toastQueue.push({ type, message });
            };
        })();
    </script>
</div>
