<div>
    <figure class="p-8 bg-gray-100 md:flex rounded-xl md:p-0">
        <img class="rounded-full md:float-left w-50 h-50 md:w-80 md:h-auto md:rounded-none" src="img/logo.png" alt="" width="384" height="512">
        <div class="pt-6 space-y-4 text-center md:p-8 md:text-left">
            <blockquote>
            <p class="text-lg font-semibold">
                {{ $empresa->nombre}}
            </p>
            </blockquote>
            <figcaption class="font-medium">
            <div class="text-cyan-600">
                {{ $empresa->direccion}}<br>
                {{ $empresa->email}}<br>
                {{ $empresa->telefono}}
            </div>
            <div class="text-gray-500">
                <a href="https://all4streaming.com">{{ $empresa->web}}</a>
            </div>
            </figcaption>
        </div>
    </figure>
    @if (session()->has('message'))
        <div class="mx-auto w-2/3 border border-red-900 rounded-full bg-red-600 text-center">
            <p class="text-white font-bold">{{ session('message') }} </p>
            <button wire:click="cerrar()" class="text-white font-bold bg- focus:border-red-900">Cerrar</button>
        </div>
    @endif
    {{-- @if($alertas)
        <div class="border border-red-900 mx-auto text-center rounded-full bg-red-600">
            <p class="text-white font-bold">Hay {{ count($alertas) }} Alertas de Cobro el día de hoy, haga <a href="">click aquí</a> si desea Enviar</p>
        </div>
    @endif --}}
</div>
