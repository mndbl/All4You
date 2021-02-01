<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Item;
use App\Models\Pendiente;
use Livewire\Livewire;
use PhpParser\Node\Expr\YieldFrom;
use Mail;
use Carbon\Carbon; 
class Facturacion extends Component
{
    //variables de facturación
    public $tipoContrato, $intercambio, $interc = false, $fechaFact, $fechaVcto, $factura, $suma = 0, $sumatorias, 
            $cuotas, $monto, $ultimoContrato;
    
    //variables de clientes
    public $nic, $cliente, $email, $telefono, $canal, $pais, $representante, $clienteSel,
            $clienteB = "", $cliente_id, $modalClte = false;
    //variables de servicios
    public $tipo, $descripcion, $servicioB, $serv_id, $precio, $cuota, $modalServ = false; 
    //variables de Items
    public function render()
    {
        return view('livewire.facturacion',[
            'servicios' => Servicio::where('tipo', 'like', '%'. $this->tipo . '%')->get(),
            'clientes' => Cliente::where('nombre', 'like', '%' . $this->clienteB . '%')->get(),
            'items' => Item::where('contrato_id', $this->factura)->get(),
            'contratos' => Contrato::with('items', )->get(),
            
        ]);
    }
    public function resetTodo(){
        $this->resetCltes();
        $this->resetserv();
        $this->mount();
    }
    //Sección de clientes
    public function resetCltes(){
        $this->reset([
            'nic', 'cliente', 'clienteB', 'cliente_id', 'email', 'telefono', 'canal',
            'pais', 'representante',
        ]);        
    }

    public function nvoCliente(){
        $this->modalClte = true;
        $this->resetCltes();
    }

    public function selectClte(){
        $this->clienteSel = Cliente::where('id', $this->cliente_id)->first(); 
        
    }
    


    public function storeCliente()
    {
        $this->validate([
            'nic' => 'required',
            'cliente' => 'required|min:6',
            'email' => 'required|email',
            'telefono' => 'required',
            'canal' => 'required',
            'pais' => 'required',
            'representante' => 'required',
        ]);
   
        Cliente::updateOrCreate(['id' => $this->cliente_id], [
            'nic' => $this->nic,
            'nombre' => $this->cliente,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'canal' => $this->canal,
            'pais' => $this->pais,
            'representante' => $this->representante,
        ]);
  
        session()->flash('message', 
            $this->cliente_id ? 'Cliente Editado Exitosamente.' : 'Cliente Creado Exitosamente.');
  
        $this->modalClte = false;
        $this->resetCltes();
    }

    public function editClte()
    {
        $cliente = Cliente::where('id', $this->cliente_id)->first(); 
        // $cliente = Cliente::findOrFail($id);
        $this->cliente_id = $cliente->id;
        $this->nic = $cliente->nic;
        $this->cliente = $cliente->nombre;
        $this->email = $cliente->email;
        $this->telefono = $cliente->telefono;
        $this->canal = $cliente->canal;
        $this->pais = $cliente->pais;
        $this->representante = $cliente->representante;
    
        $this->modalClte = true;
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function deleteClte($id)
    {
        Cliente::find($id)->delete();
        session()->flash('message', 'Cliente Eliminado Exitosamente.');
    }

    //Sección de Servicios
    public function resetServ(){
        $this->tipoContrato ="";
        $this->reset([
            'tipo', 'serv_id',  'descripcion', 'servicioB', 'precio', 'cuota', 'suma'
        ]);        
    }

    public function nvoServ(){
        $this->modalServ = true;
        $this->resetServ();
    }

    public function storeServ()
    {
        
        $this->validate([
            'tipo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            ]);
            
        Servicio::updateOrCreate(['id' => $this->serv_id], [
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            ]);
            
            session()->flash('message', 
            $this->cliente_id ? 'Servicio Editado Exitosamente.' : 'Servicio Creado Exitosamente.');
        $this->modalServ = false;
        $this->resetServ();
    }

    public function editServ($id)
    {
        $servicio = Servicio::findOrFail($id);
        $this->serv_id = $id;
        $this->tipo = $servicio->tipo;
        $this->descripcion = $servicio->descripcion;
        $this->precio = $servicio->precio;
        $this->modalServ = true;
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function deleteServ($id)
    {
        Servicio::find($id)->delete();
        session()->flash('message', 'Servicio Eliminado Exitosamente.');
    }

    //sección de items
    public function tipoContrato($id){
        $servSel = Servicio::select('descripcion','precio')->findOrFail($id);
        $this->descripcion = $servSel->descripcion;
        
        if($this->tipoContrato == "Intercambio"):
            $this->interc = true;
        else:
            $this->interc = false;
        endif;

        switch($this->tipoContrato){
            case 'Contado':
                $this->intercambio="";
                $this->cuota = 1;
                $this->precio = number_format($servSel->precio / 12 * 10, 2);
            break;
            case 'Cuotas':
                $this->intercambio="";
                $this->cuota = 12;
                $this->precio = number_format($servSel->precio / $this->cuota, 2);
            break;
            case 'Convenio':
                $this->intercambio="";
                $this->cuota = 0;
                $this->precio = 0;
            break;
        }
    }
    public function mount(){
        
        $this->sumatorias = Item::where('contrato_id', $this->factura)->get();
        foreach($this->sumatorias as $sumatoria):
            if(!$sumatoria->intercambio > ""):
                $this->suma = number_format($this->suma + ($sumatoria->cuotas * $sumatoria->monto), 2);
            endif;
        endforeach;
    }
  
    public function itemsAdds(){
        //se crea el registro en la tabla contratos
        Contrato::updateOrCreate(['id' => $this->factura], [
            'fecha' => $this->fechaFact,
            'cliente_id' => $this->cliente_id,
        ]);
        $this->ultimoContrato = Contrato::latest('id')->first();
        $this->factura = $this->ultimoContrato->id;
        
        if($this->intercambio):
            $this->validate([
                'fechaFact' => 'required|date',
                'serv_id' => 'required',
                'clienteSel' => 'required',
                'intercambio' => 'required|min:4',
                ]);
            Item::create([
                'contrato_id' => $this->factura,
                'servicio' => $this->tipo . ' ' . $this->descripcion,
                'tipoContrato' => $this->tipoContrato,
                'intercambio' => $this->intercambio,
                ]);

        else:
            $this->validate([
                'fechaFact' => 'required|date',
                'serv_id' => 'required',
                'clienteSel' => 'required',
                'cuota' => 'required|numeric',
                'precio' => 'required|numeric',
                ]);
            Item::create([
                'contrato_id' => $this->factura,
                'servicio' => $this->tipo . ' ' . $this->descripcion,
                'tipoContrato' => $this->tipoContrato,
                'cuotas' => $this->cuota,
                'monto' => $this->precio,
                ]);
        endif;
        $this->suma = 0;
        $this->mount();
    }
    public function elItem($id){
        Item::destroy($id);
        $this->suma = 0;
        $this->mount();
    }
    //Sección de factura
    public function fecha(){
        
        
        // session()->flash('message', 
        // 'Capturada la fecha.');
        //calcular cuotas
    }
    public function genFact(){
        // fecha, cliente_id, monto, status
        $this->validate([
            'fechaFact' => 'required|date',
            'cliente_id' => 'required',
            'suma' => 'required|numeric',
        ]);
        // dd([$this->fechaFact, $this->cliente_id, $this->suma, $this->sumatorias, $this->factura]);
        // se agregan las cuotas por cobrar
        foreach ($this->sumatorias as $calculo) {
            if(!$calculo->intercambio):
                $this->fechaVcto = Carbon::createFromDate($this->fechaFact);
                for ($i=0; $i < $calculo->cuotas; $i++) {
                    //con este if se agrega un mes a partir de la cuota no. 2
                    if ($i > 0) {
                        $fechaVcto = $this->fechaVcto->addMonth();
                    } else {
                        $fechaVcto = $this->fechaVcto;
                    }
                    //se agregan las cuotas a la tabla pendientes
                    Pendiente::create([
                    'contrato_id' => $this->factura,
                    'fechaVenc' => $fechaVcto->format('Y-m-d'),
                    'cuota' => $i + 1,
                    'monto' => $calculo->monto,
                    'status' => 'p'
                    ]);
                }
            endif;
        }
        Contrato::where('id',$this->factura)->update(['monto' => $this->suma]);
        $empresa = Empresa::select(['nombre', 'direccion', 'email', 'telefono', 'web'])->where('id', 1)->first();
        $facturaClte = Contrato::with(['cliente', 'items'])->where('id', $this->factura)->where('cliente_id', $this->cliente_id)->first();
        
        $this->email = $facturaClte->cliente->email;
        $this->nombre = $facturaClte->cliente->nombre;
        Mail::send('livewire.enviarFactura',
        compact(['empresa', 'facturaClte']),
            function($message){
                $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                $message->to($this->email, $this->nombre)->subject('Contrato');
            }
        );
        session()->flash('message', 'Contrato Generado Exitosamente.');
        $this->render();
        $this->resetTodo();
        $this->factura = '';
    }
    public function eliminarContrato($id){
        $contratoAEliminar = Contrato::findOrFail($id);

        session()->flash('message', 'Contrato Eliminado Exitosamente.');
    }
}
