@if ($paginator->hasPages())
<nav class="mt-8 flex items-center justify-center gap-3 text-sm">
    @if ($paginator->onFirstPage())
        <span class="rounded-full px-4 py-2 text-stone-400 ring-1 ring-stone-200"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Sebelumnya</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="rounded-full bg-white px-4 py-2 font-medium ring-1 ring-stone-200 hover:ring-orange-400"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Sebelumnya</a>
    @endif
    <span class="text-stone-500">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="rounded-full bg-white px-4 py-2 font-medium ring-1 ring-stone-200 hover:ring-orange-400">Berikutnya <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    @else
        <span class="rounded-full px-4 py-2 text-stone-400 ring-1 ring-stone-200">Berikutnya <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
    @endif
</nav>
@endif
