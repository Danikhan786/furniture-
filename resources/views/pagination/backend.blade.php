@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-between">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                @if($paginator->onFirstPage())
                    <span class="page-link">« Previous</span>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">« Previous</a>
                @endif
            </li>
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                @if($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next »</a>
                @else
                    <span class="page-link">Next »</span>
                @endif
            </li>
        </ul>
    </nav>
    <style>
        .pagination .page-link {
            color: #0062ff !important;
            border-color: #0062ff !important;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover:not(.disabled),
        .pagination .page-link:focus:not(.disabled) {
            background-color: #0062ff !important;
            color: white !important;
            border-color: #0062ff !important;
        }
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            color: #6c757d !important;
            border-color: #dee2e6 !important;
        }
    </style>
@endif

