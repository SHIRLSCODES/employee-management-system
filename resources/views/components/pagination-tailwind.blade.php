<div class="mt-4 flex flex-col items-center space-y-2">
  
  {{-- Showing results info --}}
  <div class="text-sm text-gray-600">
    Showing {{ $items->lastItem() }} of {{ $items->total() }} results
  </div>

  {{-- Pagination links --}}
  <div class="flex space-x-1">
    {{-- Previous --}}
    @if ($items->onFirstPage())
      <button disabled class="px-3 py-1 rounded border border-blue-600 text-blue-600 opacity-50 cursor-not-allowed">
        ‹
      </button>
    @else
      <a href="{{ $items->previousPageUrl() }}" class="px-3 py-1 rounded border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
        ‹
      </a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
      @if ($page == $items->currentPage())
        <button aria-current="page" class="px-4 py-1 rounded border border-blue-600 text-white bg-blue-600 cursor-default">
          {{ $page }}
        </button>
      @else
        <a href="{{ $url }}" class="px-4 py-1 rounded border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
          {{ $page }}
        </a>
      @endif
    @endforeach

    {{-- Next --}}
    @if ($items->hasMorePages())
      <a href="{{ $items->nextPageUrl() }}" class="px-3 py-1 rounded border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
        ›
      </a>
    @else
      <button disabled class="px-3 py-1 rounded border border-blue-600 text-blue-600 opacity-50 cursor-not-allowed">
        ›
      </button>
    @endif
  </div>
</div>
