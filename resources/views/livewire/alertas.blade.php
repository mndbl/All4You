<div class="overflow-x-auto">
    <div class="mx-auto mb-2 w-3/4 flex space-x-4 pb-2">
        <div class="w-1/2 justify-end">
            <button class="float-right h-full w-24 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="render()">Recargar</button> 
        </div>
        @if($alertas->count())
            <div class="w-1/2">
                <div class="w-max-content">
                    {{ $alertas->onEachSide(0)->links() }}
                </div>
            </div>
        @endif
        
    </div>
    <table class="mb-4 mx-auto bg-white rounded shadow-md text-md">
        <thead>
            <tr class="border-b">
                {{-- <th class="p-3 px-5 text-left">Item</th> --}}
                <th class="p-3 px-5 text-left w-1/6">Nro. Contrato</th>
                <th class="p-3 px-5 text-left w-1/6">Nro. de Cuota</th>
                <th class="p-3 px-5 text-left w-1/6">Fecha de Venc</th>
                <th class="p-3 px-5 text-left w-1/6">Monto</th>
                {{-- <th class="p-3 px-5 text-left w-1/6">Opciones</th> --}}
            </tr>    
        </thead>
        <tbody>
            @forelse($alertas as $alerta)
                <tr class="bg-gray-100 border-b hover:bg-orange-100">
                    
                    <td class="p-3 px-5 w-1/6">{{ sprintf("%04d", $alerta->contrato_id) }}</td>
                    <td class="p-3 px-5 w-1/6">{{ $alerta->cuota }}</td>
                    <td class="p-3 px-5 w-1/6">{{ $alerta->fechaVenc }}</td>
                    <td class="p-3 px-5 w-1/6">{{ number_format($alerta->monto, 2) }}</td>
                    {{-- <td class="flex justify-star p-3 px-5 w-1/6">
                        <button type="button" wire:click="cobrar({{ $alerta->id }})" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Cobrar</button>
                        <button type="button" wire:click="cobrar({{ $alerta->id }})" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Alerta</button></td> --}}
                </tr>
            @empty
                <tr>
                    <td class="p-3 px-5">No existen alertas Registrados</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
</div>

