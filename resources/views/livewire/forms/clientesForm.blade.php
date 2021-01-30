<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
  
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
  
    <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form>
      <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  {{-- <label for="nic" class="block mb-2 text-sm font-bold text-gray-700">NIC:</label> --}}
                  <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="nic" placeholder="NIC" wire:model="nic">
                  @error('nic') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                  {{-- <label for="cliente" class="block mb-2 text-sm font-bold text-gray-700">Nombre:</label> --}}
                  <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="cliente" wire:model="cliente" placeholder="Nombre">
                  @error('cliente') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                  {{-- <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email:</label> --}}
                  <input type="email" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="email" wire:model="email" placeholder="Email">
                  @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                {{-- <label for="telefono" class="block mb-2 text-sm font-bold text-gray-700">Teléfono:</label> --}}
                <input type="phone" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="telefono" placeholder="Teléfono" wire:model="telefono">
                @error('telefono') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                {{-- <label for="canal" class="block mb-2 text-sm font-bold text-gray-700">Canal:</label> --}}
                <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="canal" placeholder="Canal" wire:model="canal">
                @error('canal') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                {{-- <label for="pais" class="block mb-2 text-sm font-bold text-gray-700">País:</label> --}}
                <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="pais" placeholder="País" wire:model="pais">
                @error('pais') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                {{-- <label for="representante" class="block mb-2 text-sm font-bold text-gray-700">Representante:</label> --}}
                <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="representante" placeholder="Representante" wire:model="representante">
                @error('representante') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
      </div>
  
      <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click.prevent="storeCliente()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5">
            Guardar
          </button>
        </span>
        <span class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto">
            
          <button wire:click="$set('modalClte', false)" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5">
            Cancelar
          </button>
        </span>
        </form>
      </div>
        
    </div>
  </div>
</div>