@if ($paginator->hasPages())

    <div class="pagination">

        <p class="pagination-info">

            Mostrando

            <strong>
                {{ $paginator->firstItem() }}
            </strong>

            a

            <strong>
                {{ $paginator->lastItem() }}
            </strong>

            de

            <strong>
                {{ $paginator->total() }}
            </strong>

            registros

        </p>


        <div class="pagination-links">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())

                <span class="pagination-link disabled">
                    <x-icon
                        name="chevron-left"
                        size="sm"
                    />
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="pagination-link"
                    aria-label="Anterior"
                >

                    <x-icon
                        name="chevron-left"
                        size="sm"
                    />

                </a>

            @endif


            {{-- Páginas --}}
            @foreach ($elements as $element)

                @if (is_string($element))

                    <span class="pagination-link disabled">
                        {{ $element }}
                    </span>

                @endif


                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span class="pagination-link active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="pagination-link"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach


            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="pagination-link"
                    aria-label="Siguiente"
                >

                    <x-icon
                        name="chevron-right"
                        size="sm"
                    />

                </a>

            @else

                <span class="pagination-link disabled">

                    <x-icon
                        name="chevron-right"
                        size="sm"
                    />

                </span>

            @endif

        </div>

    </div>

@endif