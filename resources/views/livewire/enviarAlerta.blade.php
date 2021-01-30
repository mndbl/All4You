<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.8.10/tailwind.min.css">

    <!-- Include the Livewire styles -->
    @livewireStyles
</head>
<body class="antialiased overflow-x-hidden">
<h3>Estimado: <strong> {{ $alerta->cliente->nombre }} </strong></h3>
<h3>Representante de: <strong> {{ $alerta->cliente->canal }} </strong></h3>
<p>Es grato para nosotros saludarles, deseando el mayor de los éxitos a su canal. <br>
El presente correo es para hacer de su conocimiento que el próximo <strong>{{ $alerta->fechaVenc }}</strong>,<br>
vencerá la cuota Nro.: <strong>{{ $alerta->cuota}}</strong>, por un monto de: <strong>${{ number_format($alerta->monto, 2) }}</strong>, <br>
correspondiente al Contrato Nro.: <strong>{{ sprintf("%04d", $alerta->contrato_id)}}</strong>,
de fecha: <strong>{{ $alerta->contrato->fecha}}</strong>. <br>
Mucho sabremos agradecer tomar las previsiones correspondientes para cancelar dicha cuota.</p>

    

    <!-- Include the Livewire Scripts -->
    @livewireScripts
</body>
</html>
   
