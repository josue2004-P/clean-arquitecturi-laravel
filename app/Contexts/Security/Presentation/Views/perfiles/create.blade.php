{{-- CONTENEDOR RAÍZ SIN LÍMITE DE ANCHO PARA QUE EL HEADER SE DESPLIEGUE A TODO LO ANCHO --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Componente Header de Shared a todo lo ancho, alineado a la izquierda --}}
    <x-shared::common.header 
        title="Nuevo Perfil de Acceso" 
        icon="fa-shield-halved"
        desc="Establece las bases para la jerarquía de permisos del sistema."
        :breadcrumb="[
            ['label' => 'Perfiles', 'url' => route('perfiles.index')],
            ['label' => 'Nuevo Perfil', 'url' => null]
        ]"
    />

    {{-- CONTENEDOR LIMITADO (MAX-W-4XL) ALINEADO A LA IZQUIERDA (SIN mx-auto) --}}
    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Arquitectura del Rol" 
                desc="El nombre debe ser único y descriptivo para facilitar la administración." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Nombre Clave --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5 relative group">
                            <x-shared::form.text-input 
                                id="nombre" 
                                type="text" 
                                wire:model="nombre" 
                                placeholder="ej: administrador, tecnico_lab" 
                                class="lowercase w-full font-mono font-bold text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    
                    {{-- Descripción Funcional --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                id="descripcion" 
                                type="text" 
                                wire:model="descripcion" 
                                placeholder="Ej. Acceso total a reportes" 
                                class="w-full font-medium bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                </div>
                
                {{-- Footer con alineación y contraste perfecto --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('perfiles.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 dark:text-gray-400 dark:hover:text-red-400 transition-colors duration-150">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg shadow-indigo-500/10 dark:shadow-indigo-500/5 px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-shield-check mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Registrar Perfil</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>