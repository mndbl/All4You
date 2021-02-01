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
        @if($pendientes->count())
        <div class="w-1/2">
            <div class="w-max-content">
                {{ $pendientes->onEachSide(0)->links() }}
            </div>
        </div>
        @endif
    </div>

    <table class="mb-4 bg-white rounded shadow-md text-md">
        <thead>
            <tr class="border-b">
                {{-- <th class="p-3 px-5 text-left">Item</th> --}}
                <th class="p-3 px-5 text-left w-1/6">Nro. Contrato</th>
                <th class="p-3 px-5 text-left w-1/6">Nro. de Cuota</th>
                <th class="p-3 px-5 text-left w-1/6">F/Vcto</th>
                <th class="p-3 px-5 text-left w-1/6">Monto</th>
                <th class="p-3 px-5 text-left w-1/6">Status</th>
                <th class="p-3 px-5 text-left w-1/6">Opciones</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendientes as $porcobrar)
            <tr class="bg-gray-100 border-b hover:bg-orange-100">
                {{-- <td class="p-3 px-5">Nro. Item</td> --}}
                <td class="p-3 px-5 w-1/6">{{ sprintf("%04d",$porcobrar->contrato_id) }}</td>
                <td class="p-3 px-5 w-1/6">{{ $porcobrar->cuota }}</td>
                <td class="p-3 px-5 w-1/6">{{ $porcobrar->fechaVenc }}</td>
                <td class="p-3 px-5 w-1/6">{{ number_format($porcobrar->monto, 2) }}</td>
                @if($porcobrar->status == 'p')
                <td class="p-3 px-5 w-1/6">Pendiente</td>
                @else
                <td class="p-3 px-5 w-1/6">Alerta Enviada</td>
                @endif

                <td class="flex justify-star p-3 px-5 w-1/6">
                    <button type="button" wire:click="cobrar({{ $porcobrar->id }})" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Cobrar</button>
                    <button type="button" wire:click="alerta({{ $porcobrar->id }})" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Alerta</button></td>
            </tr>
            @empty
            <tr>
                <td class="p-3 px-5">No existen cuentas por cobrar</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{-- @if($pendientes->count())
                <div class="w-1/2">
                    <div class="w-max-content">
                        {{ $pendientes->onEachSide(0)->links() }}
</div>
</div>
@endif
</div>

<table class="mb-4 bg-white rounded shadow-md text-md">
    <thead>
        <tr class="border-b">

            <th class="p-3 px-5 text-left w-1/6">Nro. Contrato</th>
            <th class="p-3 px-5 text-left w-1/6">Nro. de Cuota</th>
            <th class="p-3 px-5 text-left w-1/6">F/Vcto</th>
            <th class="p-3 px-5 text-left w-1/6">Monto</th>
            <th class="p-3 px-5 text-left w-1/6">Status</th>
            <th class="p-3 px-5 text-left w-1/6">Opciones</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($pendientes as $porcobrar)
        <tr class="bg-gray-100 border-b hover:bg-orange-100">

            <td class="p-3 px-5 w-1/6">{{ sprintf("%04d",$porcobrar->contrato_id) }}</td>
            <td class="p-3 px-5 w-1/6">{{ $porcobrar->cuota }}</td>
            <td class="p-3 px-5 w-1/6">{{ $porcobrar->fechaVenc }}</td>
            <td class="p-3 px-5 w-1/6">{{ number_format($porcobrar->monto, 2) }}</td>
            @if($porcobrar->status == 'p')
            <td class="p-3 px-5 w-1/6">Pendiente</td>
            @else
            <td class="p-3 px-5 w-1/6">Alerta Enviada</td>
            @endif

            <td class="flex justify-star p-3 px-5 w-1/6">
                <button type="button" wire:click="cobrar({{ $porcobrar->id }})" class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Cobrar</button>
                <button type="button" wire:click="alerta({{ $porcobrar->id }})" class="px-2 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">Alerta</button></td>
        </tr>
        @empty
        <tr>
            <td class="p-3 px-5">No existen cuentas por cobrar</td>
        </tr>
        @endforelse

    </tbody>
</table> --}}
</div>
