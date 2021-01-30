<div class="shadow m-2 p-2 rounded-lg border border-blue-600">
    @if($modalClte)
        @include('livewire.forms.clientesForm')
    @else
        <button class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="$set('modalClte', true)">Agregar Cliente</button> 
    @endif
    @if($cliente_id)
      <button class="mt-2 px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="editClte()">Editar Cliente</button>  
      <button class="mt-2 px-2 py-1 mr-3 text-sm text-white bg-orange-500 rounded hover:bg-orange-700 focus:outline-none focus:shadow-outline" wire:click="resetCltes()">Limpiar Búsquedas</button>  
    @endif
    <div class="flex space-x-2 mt-2">
        <input class="w-1/2 h-full rounded-md border hover:border-blue-600" type="search" wire:model='clienteB' placeholder=" Busque por Nombre de Cliente">
        <select class="text-gray-500 w-1/2 h-full hover:bg-blu-200 rounded-md border border-blue-600 focus:border-blue-600" name="clientes" wire:model="cliente_id"  wire:change='selectClte()' {{ $cliente_id ? "" : "autofocus"}}>
            <option selected>Seleccionar Cliente</option>
            @forelse ($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : ''}}>
            {{ $cliente->nombre }}</option>
            @empty
                <option selected>No hay clientes cargados</option>    
            @endforelse
        </select>
        @error('cliente_id') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>