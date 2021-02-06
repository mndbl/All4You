<div class="overflow-x-auto">
    <div class="mx-auto mb-2 w-3/4 flex space-x-4 pb-2">
        <div class="w-1/2 justify-end">
            <button class="float-right h-full w-24 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="render()">Recargar</button>
        </div>
        @if($cobros->count())
        <div class="w-1/2">
            <div class="w-max-content">
                {{ $cobros->onEachSide(0)->links() }}
            </div>
        </div>
        @endif
    </div>
    <table class="mb-4 mx-auto bg-white rounded shadow-md text-md">
        <thead>
            <tr class="border-b">
                <th class="p-3 px-5 text-center w-1/6">Fecha de Cobro</th>
                <th class="p-3 px-5 text-left w-1/5">Nro. Contrato | Cliente</th>
                <th class="p-3 px-5 text-center w-1/12">Nro. de Cuota</th>
                <th class="p-3 px-5 text-center w-1/12">Monto</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cobros as $cobro)
            <tr class="bg-gray-100 border-b hover:bg-orange-100">
                <td class="p-3 px-5 w-1/6 text-center">{{ $cobro->fechaCobro }}</td>
                <td class="p-3 px-5 w-1/5">{{ sprintf("%04d", $cobro->contrato_id) . ' | ' . $cobro->cliente->nombre }}</td>
                <td class="p-3 px-5 w-1/12 text-center">{{ sprintf("%02d", $cobro->cuota) }}</td>
                <td class="p-3 px-5 w-1/12 text-right">{{ number_format($cobro->monto, 2) }}</td>
                @empty
            <tr>
                <td class="p-3 px-5" colspan=3>No existen Cobros Registrados</td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>
