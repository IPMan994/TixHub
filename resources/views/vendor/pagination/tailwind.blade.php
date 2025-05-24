@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-8">
        <div class="flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 border rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                    &laquo; Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 border rounded-md bg-white text-indigo-600 hover:bg-indigo-50 transition">
                    &laquo; Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 border rounded-md bg-white text-gray-500">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 border rounded-md bg-indigo-600 text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 border rounded-md bg-white text-indigo-600 hover:bg-indigo-50 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 border rounded-md bg-white text-indigo-600 hover:bg-indigo-50 transition">
                    Next &raquo;
                </a>
            @else
                <span class="px-4 py-2 border rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                    Next &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif