<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle w-10/12 px-4" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <button type="button" wire:click="$set('detalles', false)" class="px-2 py-1 left-10 mt-2 text-sm text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline">Cerrar Ventana de Detalles</button>
            <table class="mb-4 bg-white rounded shadow-md text-md">
                <thead>
                    <tr class="border-b">
                        {{-- <th class="p-3 px-5 text-left">Item</th> --}}
                        <th class="p-3 px-5 text-left w-1/5">Nro. Contrato | Cliente</th>
                        <th class="p-3 px-5 text-left w-1/12">Nro. de Cuota</th>
                        <th class="p-3 px-5 text-left w-1/6">F/Vcto</th>
                        <th class="p-3 px-5 text-left w-1/12">Monto</th>
                        <th class="p-3 px-5 text-left w-1/6">Status</th>
                        <th class="p-3 px-5 text-left w-1/6">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($itemsContrato->detalles as $item)
                    <tr class="bg-gray-100 border-b hover:bg-orange-100">
                        {{-- <td class="p-3 px-5">Nro. Item</td> --}}
                        <td class="p-3 px-5 w-1/5">{{ sprintf("%04d",$item->contrato_id) . ' | ' . $item->contrato->cliente->nombre }}</td>
                        <td class="p-3 px-5 w-1/12">{{ $item->cuota }}</td>
                        <td class="p-3 px-5 w-1/6">{{ $item->fechaVenc }}</td>
                        <td class="p-3 px-5 w-1/12">{{ number_format($item->monto, 2) }}</td>
                        @if($item->status == 'p')
                        <td class="p-3 px-5 w-1/6">Cuota Pendiente</td>
                        @else
                        @if($item->status == 'c')
                        <td class="p-3 px-5 w-1/6">Cuota Cobrada</td>
                        @else
                        <td class="p-3 px-5 w-1/6">Alerta Enviada</td>
                        @endif
                        @endif

                        <td class="flex justify-star p-3 px-5 w-1/6">
                            <button type="button" wire:click="cobrar({{ $item->id }})" {{ $item->status == 'c' ? 'hidden': '' }} class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Cobrar</button>
                            <button type="button" wire:click="alerta({{ $item->id }})" {{ $item->status == 'c' ? 'hidden': '' }} title="{{ $item->status == 'c' ? 'Cuota Cobrada': 'Enviar Alerta' }}" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Alerta</button></td>
                    </tr>
                    @empty
                    <tr>
                        <td class="p-3 px-5">No existen cuentas por cobrar</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            @if($cobrar)
            @include('livewire.forms.cobros')
            @endif
        </div>
    </div>
</div>
