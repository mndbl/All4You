<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.8.10/tailwind.min.css">

    <!-- Include the Livewire styles -->
    @livewireStyles
    <style>
    
    </style>
</head>
<body class="antialiased overflow-x-hidden">
<figure class="p-8 bg-gray-100 md:flex rounded-xl md:p-0">
        {{-- <img class="rounded-full md:float-left w-50 h-50 md:w-80 md:h-auto md:rounded-none" src="img/logo.png" alt="" width="384" height="512"> --}}
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
<div>
    <h4>
        DATOS DE CONTRATO NO. {{ sprintf("%04d", $facturaClte->id) }}
    </h4>
    <p>Cliente: <strong>{{ $facturaClte->cliente->nombre }}</strong> | NIC: <strong>{{ $facturaClte->cliente->nic }}</strong></p>
    <p>Canal: <strong>{{ $facturaClte->cliente->canal }}</strong> | Representante: <strong>{{ $facturaClte->cliente->representante }}</strong></p>
    <p>Email: <strong>{{ $facturaClte->cliente->email }}</strong> | Teléfono: <strong>{{ $facturaClte->cliente->telefono }}</strong></p>
    <h4>SERVICIOS CONTRATADOS:</h4>
    @foreach($facturaClte->items as $item)
        <p>Servicio Contratado: <strong>{{ $item->servicio }}</strong> | Fecha: <strong>{{ $facturaClte->fecha }}</strong> </p>
        <p>Acuerdo de Pago: <strong>{{ $item->tipoContrato }} | 
            @if($item->tipoContrato <> 'Intercambio')
                <strong>{{ $item->cuotas }}</strong> cuota(s) por <strong>${{ number_format($item->monto,2) }}</strong> cada Cuota.
            @else
                que consiste en: <strong>{{ $item->intercambio }}</strong>
            @endif
        </p>
        <hr>
    @endforeach
</div>



    

    <!-- Include the Livewire Scripts -->
    @livewireScripts
</body>
</html>
   
