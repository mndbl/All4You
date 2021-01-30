<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\Pendiente;
use App\Models\Alerta;
use Carbon\Carbon; 
use Mail;
class Admin extends Component
{
    public $vencimiento="", $alertas, $alerta, $email, $nombre, $cerrar=false;
    public function render()
    {
        if (!$this->cerrar) {
            $this->enviarAlertas();
        }
        return view('livewire.admin', [
            'empresa' => Empresa::select(['nombre', 'direccion', 'email', 'telefono', 'web'])->where('id', 1)->first(),
        ]);
    }
    public function enviarAlertas(){
        $fecha = Carbon::now();
        $this->vencimiento = $fecha->addDays(4);
        $this->vencimiento = $this->vencimiento->format('Y-m-d');
        $this->alertas = Pendiente::with('contrato', 'contrato.cliente')->where('status', 'p')->where('fechaVenc', $this->vencimiento)->get();
        if (count($this->alertas) > 0) {
            foreach ($this->alertas as $alerta) {
                $this->email = $alerta->cliente->email;
                $this->nombre = $alerta->cliente->nombre;
                Mail::send('livewire.enviarAlerta',
                compact('alerta'),
                    function($message){
                        $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                        $message->to($this->email, $this->nombre)->subject('Alerta Vencimiento de Cuota');
                    }
                );
                Alerta::create([
                    'contrato_id' => $alerta->contrato_id,
                    'cuota' => $alerta->cuota,
                    'fechaVenc' => $alerta->fechaVenc,
                    'monto' => $alerta->monto,
                    'status' => 'p'
                ]);
                $alerta->update(['status' => 'e']);
            }
            session()->flash('message', 'Se Enviaron ' . sprintf("%02d", count($this->alertas)) . ' Alertas Con Éxito');
        }
        
        
    }

    public function cerrar(){
        $this->cerrar = true;
    }
}
