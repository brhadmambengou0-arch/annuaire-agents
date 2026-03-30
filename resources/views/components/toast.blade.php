{{--
    Composant toast de notification
    Usage : <x-toast />
    Affiche automatiquement les flash session 'success' et 'error'
--}}
<div
    x-data="{
        show: false,
        type: 'success',
        message: '',
        init() {
            @if(session('success'))
                this.type = 'success';
                this.message = '{{ session('success') }}';
                this.show = true;
                setTimeout(() => this.show = false, 3500);
            @elseif(session('error'))
                this.type = 'error';
                this.message = '{{ session('error') }}';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            @endif

            window.addEventListener('toast', (e) => {
                this.type = e.detail.type ?? 'success';
                this.message = e.detail.message ?? '';
                this.show = true;
                setTimeout(() => this.show = false, 3500);
            });
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-5 right-5 z-50 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium shadow-lg"
    :style="type === 'success'
        ? 'background:#0d4f7c;color:#fff;'
        : 'background:#7f1d1d;color:#fff;'"
    style="display:none;">

    <div class="w-2 h-2 rounded-full flex-shrink-0"
         :style="type === 'success' ? 'background:#4ade80;' : 'background:#f87171;'">
    </div>
    <span x-text="message"></span>
    <button @click="show = false"
            class="ml-2 opacity-60 hover:opacity-100 transition text-white"
            style="background:none;border:none;cursor:pointer;font-size:14px;">
        ✕
    </button>
</div>
