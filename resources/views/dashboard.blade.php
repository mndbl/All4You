<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <livewire:admin>
            </div>
            <div x-data="{active: 0}">
                <div class="flex -mb-px overflow-hidden border border-black">
                    <button class="w-full px-4 py-2" x-on:click.prevent="active = 0" x-bind:class="{'bg-blue-400 text-white': active === 0}">Facturación</button>
                    <button class="w-full px-4 py-2" x-on:click.prevent="active = 1" x-bind:class="{'bg-blue-400 text-white': active === 1}">Contratos</button>
                    <button class="w-full px-4 py-2" x-on:click.prevent="active = 2" x-bind:class="{'bg-blue-400 text-white': active === 2}">Cobros</button>
                    <button class="w-full px-4 py-2" x-on:click.prevent="active = 3" x-bind:class="{'bg-blue-400 text-white': active === 3}">Alertas</button>
                </div>
                <div class="-mt-px bg-white border border-black bg-opacity-10">
                    <div class="p-4 space-y-2" x-show="active === 0">
                        <livewire:facturacion>
                            {{-- <livewire:servicios> --}}
                    </div>
                    <div class="p-4 space-y-2" x-show.transition.in="active === 1">
                        <livewire:pendientes>
                    </div>
                    <div class="p-4 space-y-2" x-show="active === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100">
                        <livewire:cobros>
                    </div>
                    <div class="p-4 space-y-2" x-show="active === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100">
                        <livewire:alertas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
