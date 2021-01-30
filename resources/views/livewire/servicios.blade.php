<div class="shadow m-2 p-2 rounded-lg border border-blue-600">
    
    @if($modalServ)
        
        @include('livewire.forms.servForm')
    @else
        @if($serv_id)
            <button class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="editServ({{$serv_id}})">Editar Servicio</button><br>
        @else
            <button class="px-2 py-1 mr-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" wire:click="$set('modalServ', true)">Crear Servicio</button><br>
        @endif
            
    @endif
    <div class="w-auto flex space-x-2">
        <select class="mt-2 w-1/3 rounded-m border border-blue-600 focus:border-blue-600" name="selTipo" wire:model="tipo">
            <option selected>Tipo de Serv...</option>
            <option value="Audio">Audio</option>
            <option value="Video">Video</option>
            <option value="App">App</option>
        </select>
        @error('selTipo') <span class="error">{{ $message }}</span> @enderror

        <select class="mt-2 w-1/3 rounded-m border border-blue-600 focus:border-blue-600" name="selServ" wire:model="serv_id" {{ $tipo ? "" : "disabled" }}>
            <option>Seleccione Servicio</option>
            @forelse($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->descripcion }}</option>
            @empty
                <option selected>Seleccione Tipo</option>
            @endforelse
        </select>
        @error('selServ') <span class="error">{{ $message }}</span> @enderror

        <select class="mt-2 w-1/3 rounded-m border border-blue-600 focus:border-blue-600" name="tipoContrato" wire:model="tipoContrato" wire:click='tipoContrato({{ $serv_id }})' {{ $serv_id ? "autofocus" : "disabled" }}>
            <option selected>Tipo de Contrato</option>
            <option value="Contado">Contado</option>
            <option value="Cuotas">Cuotas</option>
            <option value="Convenio">Convenio</option>
            <option value="Intercambio">Intercambio</option>
        </select><br>
        @error('tipoContrato') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="w-auto mt-2 flex space-x-2">
        @if ($interc)
            <input class="w-full border border-blue-600" name="intercambio" wire:model='intercambio' type="text" placeholder=" Describa el Intercambio"/>
            @error('intercambio') <span class="error">{{ $message }}</span> @enderror
        @else
            <label for="cuotas">Cuota(s): </label>
            <input class="w-24 border border-blue-600" id="cuotas" name="cuotas" wire:model='cuota' type="number" placeholder="Cuotas" {{ $tipoContrato == "Convenio" ? "autofocus" : "disabled" }}/>
            @error('cuota') <span class="error">{{ $message }}</span> @enderror
            <label for="precio">Monto: </label>
            <input class="w-24 border border-blue-600" id="precio" name="precio" wire:model='precio' type="number" placeholder="Monto" {{ $tipoContrato == "Convenio" ? "" : "disabled" }}/>
            @error('precio') <span class="error">{{ $message }}</span> @enderror
        @endif
        <div x-data="{ tooltip: false }" class="relative inline-flex">
            <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" wire:click='itemsAdds()' class="px-2 text-white bg-blue-500 rounded-md shadow cursor-pointer">
            +
            </div>
            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                <div class="absolute top-0 z-10 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-blue-500 rounded-lg shadow-lg">
                    Agregar Item
                </div>
                <svg class="absolute z-10 w-12 h-6 text-blue-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                    <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                </svg>
            </div>
        </div>
    </div>
    {{-- <table class="w-full table-fixed">
        <thead>
            <tr class="bg-gray-100">
                <th class="w-20 px-4 py-2">No.</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Body</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td class="px-4 py-2 border">{{ $post->id }}</td>
                <td class="px-4 py-2 border">{{ $post->title }}</td>
                <td class="px-4 py-2 border">{{ $post->body }}</td>
                <td class="px-4 py-2 border">
                <button wire:click="edit({{ $post->id }})" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit</button>
                    <button wire:click="delete({{ $post->id }})" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>
