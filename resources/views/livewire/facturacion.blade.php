<div class="container flex border border-blue-500 rounded shadow-blue">
    <div class="w-1/2">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="text-center font-bold ring-2 ring-green-700 bg-green-400 rounded-lg m-2">
                    <h1>{{ session('message') }}</h1>
                </div>
            @endif
        </div>
        @include('livewire.contrato')
    </div>
    <div class="w-1/2">
        @include('livewire.clientes')
        @include('livewire.servicios')
    </div>
    
</div>