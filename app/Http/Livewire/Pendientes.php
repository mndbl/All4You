<?php

namespace App\Http\Livewire;
use App\Models\Contrato;
use App\Models\Pendiente;
use App\Models\Cobro;
use App\Models\Alerta;
use Livewire\Component;
use Livewire\WithPagination;
use Mail;
class Pendientes extends Component
{
    use WithPagination;
    public $cobrar = false, $pendiente_id, $contrato, $cuota, $monto, $fechaVcto, $fechaCobro, 
        $detalles = false, $itemsContrato;
    public function render()
    {
        return view('livewire.pendientes', [
            'contratos' => Contrato::with('cliente', 'items')->paginate(10),
            
        ]);
    }

    public function cobrar($id){
        $cuotaSel = Pendiente::findOrFail($id);
        $this->pendiente_id = $cuotaSel->id;
        $this->contrato = sprintf("%04d", $cuotaSel->contrato_id);
        $this->fechaVcto = $cuotaSel->fechaVenc;
        $this->cuota = $cuotaSel->cuota;
        $this->monto = number_format($cuotaSel->monto, 2);
        $this->cobrar = true;
    }

    public function cobranza(){
        $this->cobrar = false;
        $this->validate([
            'fechaCobro' => 'required|date'
        ]);
        Cobro::create([
            'pendiente_id' => $this->pendiente_id,
            'contrato_id' => $this->contrato,
            'fechaCobro' => $this->fechaCobro,
            'cuota' => $this->cuota,
            'monto' => $this->monto
        ]);
        $cuotaCobrada = Pendiente::findOrFail($this->pendiente_id);
        $cuotaCobrada->update([
            'status' => 'c'
        ]);
        session()->flash('message', 'Cobranza Realizada Con Éxito ');
        $this->reset('fechaCobro');
    }

    public function alerta($id){
        $alerta = Pendiente::with('contrato', 'contrato.cliente')->findOrFail($id);
        $this->email = $alerta->cliente->email;
        $this->nombre = $alerta->cliente->nombre;
        Mail::send('livewire.enviarAlerta',
        compact('alerta'),
            function($message){
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->to($this->email, $this->nombre)->bcc('info@yohangarcia.com')->subject('Alerta Vencimiento de Cuota');
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
        
        session()->flash('message', 'Alerta Enviada Con Éxito a: ' . $alerta->contrato->cliente->nombre);  
    }

    public function detalleContrato($id){
        $this->itemsContrato = Contrato::where('id', $id)->first();
        $this->detalles = true;
        $this->itemsContrato->detalles()->paginate(5);
        
    }
    public function eliminarContrato($id){
        $contratoAEliminar = Contrato::destroy($id);

        session()->flash('message', 'Contrato Eliminado Exitosamente.');
    }
}
