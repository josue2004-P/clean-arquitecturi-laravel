{{-- CONTENEDOR RAÍZ SIN LÍMITE DE ANCHO PARA QUE EL HEADER SE DESPLIEGUE A TODO LO ANCHO --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Componente Header de Shared a todo lo ancho, alineado a la izquierda --}}
    <x-shared::common.header 
        title="Arquitectura de Accesos" 
        icon="fa-shield-halved"
        :desc="'Definiendo capacidades para el perfil: ' . $nombre"
        :breadcrumb="[
            ['label' => 'Perfiles', 'url' => route('perfiles.index')],
            ['label' => 'Matriz de Accesos', 'url' => null]
        ]"
    />

    {{-- CONTENEDOR LIMITADO (MAX-W-7XL) ALINEADO A LA IZQUIERDA (SIN mx-auto) --}}
    <div class="max-w-7xl text-left">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- Columna Izquierda: Identidad del Rol (4 Columnas) --}}
                <div class="lg:col-span-4 space-y-6">
                    <x-shared::common.component-card 
                        title="Identidad del Rol" 
                        desc="Información administrativa y nombre clave del perfil."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="space-y-5">
                            <div>
                                <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required class="text-gray-700 dark:text-gray-300" />
                                <div class="mt-1.5">
                                    <x-shared::form.text-input type="text" wire:model="nombre" id="nombre" class="w-full font-mono font-bold text-indigo-600 dark:text-indigo-400" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>
                            <div>
                                <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')" class="text-gray-700 dark:text-gray-300" />
                                <div class="mt-1.5">
                                    <x-shared::form.text-input type="text" wire:model="descripcion" id="descripcion" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>
                        </div>
                        
                        <x-slot:footer>
                            <x-shared::form.button-primary type="submit" class="w-full shadow-lg shadow-indigo-500/10 dark:shadow-indigo-500/5 px-5 h-11 text-xs" wire:loading.attr="disabled">
                                <i class="fa-solid fa-shield-check mr-2" wire:loading.remove></i>
                                <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                                <span>Guardar Configuración</span>
                            </x-shared::form.button-primary>
                        </x-slot:footer>
                    </x-shared::common.component-card>
                </div>

                {{-- Columna Derecha: Matriz de Permisos (8 Columnas) --}}
                <div class="lg:col-span-8">
                    <x-shared::common.component-card 
                        title="Matriz de Permisos" 
                        desc="Concede acciones específicas para cada módulo del sistema de manera atómica."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="space-y-3">
                            @foreach($permisosCatalogo as $permiso)
                                <div class="rounded-xl border border-gray-200 dark:border-gray-850 bg-gray-50/50 dark:bg-gray-900/40 hover:border-indigo-500 dark:hover:border-indigo-550 transition-all duration-200 shadow-xs" wire:key="matriz-permiso-{{ $permiso['id'] }}">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4">
                                        
                                        {{-- Identificación del Módulo --}}
                                        <div class="flex items-center gap-3.5">
                                            <div class="h-9 w-9 rounded-lg bg-white dark:bg-gray-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-gray-200 dark:border-gray-850 shadow-xs">
                                                <i class="fa-solid fa-cube text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-xs text-gray-900 dark:text-white uppercase tracking-tight">{{ $permiso['nombre'] }}</p>
                                                <p class="text-[11px] text-gray-450 dark:text-gray-500 font-medium italic mt-0.5">{{ $permiso['descripcion'] }}</p>
                                            </div>
                                        </div>

                                        {{-- Switcheo de Capacidades CRUD --}}
                                        <div class="flex flex-wrap items-center gap-2">
                                            @foreach([
                                                'is_read' => ['Leer', 'text-emerald-600 dark:text-emerald-400', 'hover:border-emerald-500/50 dark:hover:border-emerald-500/30', 'focus:ring-emerald-500/10'], 
                                                'is_create' => ['Crear', 'text-blue-600 dark:text-blue-400', 'hover:border-blue-500/50 dark:hover:border-blue-500/30', 'focus:ring-blue-500/10'], 
                                                'is_update' => ['Editar', 'text-amber-600 dark:text-amber-400', 'hover:border-amber-500/50 dark:hover:border-amber-500/30', 'focus:ring-amber-500/10'], 
                                                'is_delete' => ['Eliminar', 'text-red-600 dark:text-red-400', 'hover:border-red-500/50 dark:hover:border-red-500/30', 'focus:ring-red-500/10']
                                            ] as $key => $estilo)
                                                <label class="flex items-center px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 cursor-pointer {{ $estilo[2] }} transition-all group shadow-xs select-none">
                                                    <input 
                                                        type="checkbox" 
                                                        wire:model="matriz.{{ $permiso['id'] }}.{{ $key }}" 
                                                        class="h-4 w-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-4 dark:bg-gray-900 transition-all {{ $estilo[3] }}"
                                                    >
                                                    <span class="ml-2 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 dark:text-gray-500 group-hover:{{ $estilo[1] }} transition-colors">
                                                        {{ $estilo[0] }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-shared::common.component-card>
                </div>

            </div>
        </form>
    </div>
</div>