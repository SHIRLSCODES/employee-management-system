<?php

namespace App\Livewire\Layout;

use App\Helpers\Utility;
use App\Models\TeamUser;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
