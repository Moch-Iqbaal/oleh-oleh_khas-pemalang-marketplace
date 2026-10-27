{{-- Toast notifikasi: hilang otomatis setelah 4 detik --}}
<div id="toasts" class="pointer-events-none fixed right-4 top-20 z-50 flex w-[calc(100%-2rem)] max-w-sm flex-col gap-3">
    @foreach (['success' => 'bg-emerald-600', 'error' => 'bg-rose-600'] as $type => $color)
        @if (session($type))
            <div class="toast pointer-events-auto flex items-start gap-3 rounded-2xl {{ $color }} px-4 py-3 text-sm font-medium text-white shadow-lg transition duration-500">
                <span>{{ $type === 'success' ? '✓' : '!' }}</span>
                <p class="flex-1">{{ session($type) }}</p>
                <button type="button" onclick="this.parentElement.remove()" class="opacity-70 hover:opacity-100" aria-label="Tutup">✕</button>
            </div>
        @endif
    @endforeach
    @if ($errors->any())
        <div class="toast pointer-events-auto rounded-2xl bg-rose-600 px-4 py-3 text-sm font-medium text-white shadow-lg transition duration-500">
            Ada input yang belum benar, cek lagi form-nya ya.
        </div>
    @endif
</div>
<script>
    setTimeout(() => document.querySelectorAll('.toast').forEach(t => { t.style.opacity = 0; setTimeout(() => t.remove(), 500); }), 4000);
</script>
