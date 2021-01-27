@if ($paginator->hasPages())
    <div class="row mx-0 pagination-wrap">
        <div class="col-12 text-center pb-4 pt-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="disabled btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn_mange_pagging">
                    <i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="disabled btn_pagging">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active btn_pagging">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="btn_pagging">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
            @else
                <a class="disabled btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
            @endif
        </div>
    </div>
@endif