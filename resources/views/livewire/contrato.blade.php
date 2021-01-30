<div> 
    <div class="flex">
        <div class="text-center shadow m-2 w-1/2 p-2 rounded-lg border border-blue-600">
            <h1 class="">Fecha: <input class="border hover:border-blue-600" type="date" name="fecha" wire:change="fecha()" wire:model='fechaFact' value="{{ old("fechaFact") }}"></h1>
            @error('fechaFact') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="text-center shadow m-2 w-1/2 p-2 rounded-lg border border-blue-600">
            <h1 class="">No. de Factura: <strong>{{ sprintf("%04d", $factura) }}</strong></h1>
            @error('contratos') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="shadow ml-2 mr-2 mb-2 p-2 rounded-lg border border-blue-600">
        @if($cliente_id)
            
            <h1 class="ml-3">Cliente: <strong>{{ $clienteSel->nombre }}</strong> | NIC: <strong>{{ $clienteSel->nic}}</strong></h1>
            <h1 class="ml-3">Canal: <strong>{{ $clienteSel->canal }}</strong> | País: <strong>{{ $clienteSel->pais }}</strong></h1>
            <h1 class="ml-3">Representante: <strong>{{ $clienteSel->representante}}</strong></h1>
            <h1 class="ml-3 mb-3">Email: <strong>{{ $clienteSel->email }}</strong> | Teléfono: <strong>{{ $clienteSel->telefono }}</strong></h1>
        @else
            <h1 class="ml-3 mb-3">Seleccione un Cliente</h1>
        @endif
    </div>
    <div class="overflow-x-auto">
        <table class="mb-4 bg-white rounded shadow-md text-md">
            <thead>
                <tr class="border-b">
                    {{-- <th class="p-3 px-5 text-left">Item</th> --}}
                    <th class="p-3 px-5 text-left w-1/6">Servicio</th>
                    <th class="p-3 px-5 text-left w-1/6">Tipo Contrato</th>
                    <th class="p-3 px-5 text-left w-1/6">Cuotas</th>
                    <th class="p-3 px-5 text-left w-1/6">Monto</th>
                    <th class="p-3 px-5 text-left w-1/6">Subtotal</th>
                    <th class="p-3 px-5 text-left w-1/6">Opciones</th>
                    <th></th>
                </tr>    
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="bg-gray-100 border-b hover:bg-orange-100">
                        {{-- <td class="p-3 px-5">Nro. Item</td> --}}
                        <td class="p-3 px-5 w-1/6">{{ $item->servicio }}</td>
                        <td class="p-3 px-5 w-1/6">{{ $item->tipoContrato }}</td>
                        @if ($item->tipoContrato =="Intercambio")
                            <td class="p-3 px-5" colspan="3">{{ $item->intercambio }}</td>
                        @else
                            <td class="p-3 px-5 w-1/6">{{ $item->cuotas }}</td>
                            <td class="p-3 px-5 w-1/6">{{ number_format($item->monto, 2) }}</td>
                            <td class="p-3 px-5 w-1/6">{{ number_format($item->monto * $item->cuotas, 2)}}</td>
                        @endif
                        
                        <td class="flex justify-star p-3 px-5 w-1/6">
                            {{-- <button type="button" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Save</button> --}}
                            <button type="button" wire:click="elItem({{ $item->id }})" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Delete</button></td>
                    </tr>
                @empty
                    <tr>
                       <td colspan="4" class="p-3 px-5">No hay Items Creados</td>
                    </tr>
                @endforelse
                
            </tbody>
            <tfoot>
                <tr class="border-b">
                    <th class="p-3 px-5 text-left" colspan="2">
                    {{-- @if($this->validate) --}}
                        <button type="button" wire:click="genFact" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Generar Factura</button>
                    {{-- @endif --}}
                    </th>
                    <!-- <th class="p-3 px-5 text-left"></th> -->
                    {{-- <th class="p-3 px-5 text-left"></th> --}}
                    <th class="p-3 px-5 text-left"></th>
                    <th class="p-3 px-5 text-left">Total</th>
                    <th class="p-3 px-5 text-right w-1/6"><input class="w-full text-center" wire:model="suma" disabled></th>
                    <th class="p-3 px-5 text-left"></th>
                    <th></th>
                </tr>    
            </tfoot>
        </table>
    </div>
</div>
