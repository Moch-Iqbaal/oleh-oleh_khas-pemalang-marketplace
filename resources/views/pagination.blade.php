@if ($paginator->hasPages())
<div class="row" style="margin-top:12px">
    @if ($paginator->onFirstPage())
        <span class="badge">&laquo; Sebelumnya</span>
    @else
        <a class="badge" href="{{ $paginator->previousPageUrl() }}">&laquo; Sebelumnya</a>
    @endif
    <span>Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
        <a class="badge" href="{{ $paginator->nextPageUrl() }}">Berikutnya &raquo;</a>
    @else
        <span class="badge">Berikutnya &raquo;</span>
    @endif
</div>
@endif
