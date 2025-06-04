<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginationTailwind extends Component
{
    /**
     * Create a new component instance.
     */
    public LengthAwarePaginator $items;

    public function __construct(LengthAwarePaginator $items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination-tailwind');
    }
}
