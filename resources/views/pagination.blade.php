@if ($paginator->hasPages())
<nav class="mt-8 flex items-center justify-center gap-3 text-sm">
    @if ($paginator->onFirstPage())
        <span class="rounded-full px-4 py-2 text-stone-400 ring-1 ring-stone-200">← Sebelumnya</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="rounded-full bg-white px-4 py-2 font-medium ring-1 ring-stone-200 hover:ring-orange-400">← Sebelumnya</a>
    @endif
    <span class="text-stone-500">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="rounded-full bg-white px-4 py-2 font-medium ring-1 ring-stone-200 hover:ring-orange-400">Berikutnya →</a>
    @else
        <span class="rounded-full px-4 py-2 text-stone-400 ring-1 ring-stone-200">Berikutnya →</span>
    @endif
</nav>
@endif
