<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alerta;
use Livewire\WithPagination;
class Alertas extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.alertas', [
            'alertas' => Alerta::paginate(10)
        ]);
    }
}
