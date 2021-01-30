<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cobro;
use Livewire\WithPagination;

class Cobros extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.cobros', [
            'cobros' => Cobro::orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
