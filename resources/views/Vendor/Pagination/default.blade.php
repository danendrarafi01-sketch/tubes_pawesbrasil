@if ($paginator->hasPages())
    <div class="pager">
        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Sebelumnya</a>
        @endif

        {{-- Selanjutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Selanjutnya</a>
        @else
            <span class="disabled">Selanjutnya</span>
        @endif
    </div>
@endif
