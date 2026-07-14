{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Header del módulo de edición integrado --}}
    <x-shared::common.header 
        title="Modificar Tipo de Crédito" 
        icon="fa-credit-card"
        desc="Actualiza las propiedades de vinculación y el alcance funcional del financiamiento."
        :breadcrumb="[
            ['label' => 'Tipos de Crédito', 'url' => route('tipos-credito.index')],
            ['label' => 'Modificar Crédito', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Actualizar Datos del Crédito" 
                desc="Al modificar este registro se alterarán los criterios de selección en fichas y expedientes activos." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 gap-6">
                    {{-- Nombre --}}
                    <div>
                        <x-shared::form.input-label for="nombre" :value="__('Nombre del Crédito')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" class="w-full font-bold" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción o Alcance')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="descripcion" type="text" wire:model="descripcion" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    {{-- Flags de Aplicación --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                        <div class="flex items-start gap-3">
                            <div class="flex h-5 items-center">
                                <input id="aplica_vivienda" type="checkbox" wire:model="aplica_vivienda" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                            </div>
                            <div class="text-xs">
                                <label for="aplica_vivienda" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Aplica para Viviendas</label>
                                <p class="text-gray-400 dark:text-gray-550 font-medium mt-0.5">Determina si este financiamiento puede ligarse a las propiedades.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-5 items-center">
                                <input id="aplica_cliente" type="checkbox" wire:model="aplica_cliente" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                            </div>
                            <div class="text-xs">
                                <label for="aplica_cliente" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Aplica para Clientes</label>
                                <p class="text-gray-400 dark:text-gray-550 font-medium mt-0.5">Determina si este financiamiento puede asignarse al perfil de un prospecto.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('tipos-credito.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-circle-check mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Actualizar Esquema</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>