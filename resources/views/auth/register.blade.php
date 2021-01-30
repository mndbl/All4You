<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline mr-4 text-sm text-gray-600 hover:text-gray-900" href="{{url('/')}}">Inicio</a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <div x-data="{ tooltip: false }" class="relative inline-flex">
                    <div {{ auth()->guard()->guest() ? 'x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"' : ''}} class="ml-12 text-lg leading-7 font-semibold">
                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                        <div class="absolute w-48 top-0 right-0 z-10 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-blue-500 rounded-lg shadow-lg">
                            No está autorizado para registrarse
                        </div>
                        {{-- <svg class="absolute z-10 w-20 h-6 text-blue-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                            <rect x="12" y="-10" width="30" height="6" transform="rotate(45)" />
                        </svg> --}}
                    </div>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
