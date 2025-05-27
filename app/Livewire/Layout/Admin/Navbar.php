<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Component;

class Navbar extends Component
{
    public string $header;
    
    public function render()
    {
        return view('livewire.layout.admin.navbar');
    }
}
