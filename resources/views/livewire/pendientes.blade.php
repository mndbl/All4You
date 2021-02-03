<div class="overflow-x-auto">
    <div>
        @if (session()->has('message'))
        <div class="text-center font-bold ring-2 ring-green-700 bg-green-400 rounded-lg m-2">
            <h1 class="text-center font-bold text-white">{{ session('message') }}</h1>
        </div>
        @endif
    </div>
    @if($cobrar)
    @include('livewire.forms.cobros')
    @endif
    <div class="mx-auto mb-2 w-3/4 flex space-x-4 pb-2">
        <div class="w-1/2 justify-end">
            <button class="float-right h-full w-24 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="render()">Recargar</button>
        </div>
        @if($contratos->count())
        <div class="w-1/2">
            <div class="w-max-content">
                {{ $contratos->onEachSide(0)->links() }}
            </div>
        </div>
        @endif
    </div>

    <table class="mb-4 bg-white rounded shadow-md text-md">
        <thead>
            <tr class="border-b">
                {{-- <th class="p-3 px-5 text-left">Item</th> --}}
                <th class="p-3 px-5 text-left w-1/12">Nro. Contrato</th>
                <th class="p-3 px-5 text-left w-1/6">Fecha</th>
                <th class="p-3 px-5 text-left w-1/5">Cliente|Canal</th>
                <th class="p-3 px-5 text-left w-1/12">Monto</th>
                <th class="p-3 px-5 text-left w-1/6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @forelse($contratos as $contrato)
            <tr class="bg-gray-100 border-b hover:bg-orange-100">
                <td class="p-3 px-5 w-1/12">{{ sprintf("%04d",$contrato->id) }}</td>
                <td class="p-3 px-5 w-1/6">{{ $contrato->fecha }}</td>
                <td class="p-3 px-5 w-1/5">{{ $contrato->cliente->nombre . ' | ' . $contrato->cliente->canal}}</td>
                <td class="p-3 px-5 w-1/12">{{ number_format($contrato->monto, 2) }}</td>
                <td class="flex justify-star p-3 px-5 w-1/6">
                    <button type="button" wire:click="detalleContrato({{ $contrato->id }})" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Detalles</button>
                    <button type="button" wire:click="eliminarContrato({{ $contrato->id }})" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Eliminar</button>
                </td>
            </tr>
            @empty
            <tr>
                <td class="p-3 px-5">No existen cuentas por cobrar</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    @if($detalles)
    @include('livewire.forms.consultaContrato')
    @endif
</div>
