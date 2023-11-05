<!--pagination-->
@if ($paginator->hasPages())
    <div class="pagination">
        <div class="pagination-area">
            <div class="pagination-list">
                <ul class="list-inline">
                    @if ($paginator->onFirstPage())
                        <li class="disabled"><a><i class="las la-arrow-left"></i></a></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><a href="#">{{ $element }}</a></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><a class="active" href="#">{{ $page }}</a></li>
                                @else
                                    <li class=""><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                    @else
                        <li class="disabled"><a><i class="las la-arrow-right"></i></a></li>
                    @endif

                    {{-- <li><a href="#" class="active">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#"><i class="las la-arrow-right"></i></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
@endif
