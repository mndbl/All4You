<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio;
class Servicios extends Component
{
    public $tipoServ, $abrirModal=false;
    public function render()
    {
        return view('livewire.servicios',[
            'servicios' => Servicio::where('tipo', $this->tipoServ)->get(),
        ]);
    }
}
