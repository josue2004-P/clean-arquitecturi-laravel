<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Modificar Asentamiento" 
        icon="fa-map-location-dot"
        desc="Corrigiendo estructura geográfica administrativa del catálogo."
        :breadcrumb="[
            ['label' => 'Asentamientos', 'url' => route('asentamientos.index')],
            ['label' => 'Modificar', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Actualizar Datos del Asentamiento" 
                desc="Al modificar este registro se alterarán de manera reactiva todas las consultas sobre este código postal." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <x-shared::form.input-label for="codigo_postal" :value="__('Código Postal')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="codigo_postal" type="text" wire:model="codigo_postal" class="w-full font-mono font-bold text-indigo-600 dark:text-indigo-400" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-shared::form.input-label for="nombre_asentamiento" :value="__('Nombre del Asentamiento (Colonia)')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="nombre_asentamiento" type="text" wire:model="nombre_asentamiento" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre_asentamiento')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="tipo_asentamiento" :value="__('Tipo Asentamiento')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="tipo_asentamiento" type="text" wire:model="tipo_asentamiento" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('tipo_asentamiento')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="municipio" :value="__('Municipio o Delegación')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="municipio" type="text" wire:model="municipio" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('municipio')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="ciudad" :value="__('Ciudad (Opcional)')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="ciudad" type="text" wire:model="ciudad" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('ciudad')" class="mt-2" />
                    </div>

                    <div class="md:col-span-3">
                        <x-shared::form.input-label for="estado" :value="__('Estado')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="estado" type="text" wire:model="estado" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('estado')" class="mt-2" />
                    </div>
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('asentamientos.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-circle-check mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Actualizar Datos</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>