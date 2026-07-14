{{-- CONTENEDOR RAÍZ SIN LÍMITE DE ANCHO PARA QUE EL HEADER SE DESPLIEGUE A TODO LO ANCHO --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Componente Header de Shared a todo lo ancho, alineado a la izquierda --}}
    <x-shared::common.header 
        title="Configurar Cuenta" 
        icon="fa-user-gear"
        :desc="'Editando credenciales para el operador: ' . $usuario"
        :breadcrumb="[
            ['label' => 'Usuarios', 'url' => route('usuarios.index')],
            ['label' => 'Configurar Cuenta', 'url' => null]
        ]"
    />

    {{-- CONTENEDOR LIMITADO (MAX-W-7XL) ALINEADO A LA IZQUIERDA (SIN mx-auto) --}}
    <div class="max-w-7xl text-left">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- Columna Izquierda: Datos y Estado (7 Columnas) --}}
                <div class="lg:col-span-7 space-y-6">
                    <x-shared::common.component-card 
                        title="Credenciales Básicas" 
                        desc="Información personal esencial de contacto y acceso a plataforma."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="space-y-8">
                            
                            {{-- BLOQUE 1: DATOS PERSONALES --}}
                            <div>
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Datos Personales
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <x-shared::form.input-label for="name" :value="__('Nombre(s)')" required class="text-gray-700 dark:text-gray-300"/>
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="name" type="text" wire:model="name" placeholder="Ej. Pedro" class="w-full font-semibold" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="apellido_paterno" :value="__('Ap. Paterno')" required class="text-gray-700 dark:text-gray-300"/>
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="Ej. Picapiedra" class="w-full font-semibold" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="apellido_materno" :value="__('Ap. Materno')" required class="text-gray-700 dark:text-gray-300"/>
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="Ej. Mármol" class="w-full font-semibold" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            {{-- BLOQUE 2: IDENTIDAD --}}
                            <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Identidad en Plataforma
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-shared::form.input-label for="usuario" :value="__('Nombre de Usuario')" class="text-gray-700 dark:text-gray-300 opacity-80" />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="usuario" type="text" wire:model="usuario" readonly class="w-full h-11 bg-gray-50 dark:bg-gray-900/60 text-gray-500 dark:text-gray-400 cursor-not-allowed border-gray-200 dark:border-gray-800/80 focus:ring-0" />
                                        </div>
                                        <p class="text-[11px] font-medium text-gray-450 mt-2 flex items-center gap-1.5">
                                            <i class="fa-solid fa-lock text-[10px]"></i> Acceso inmutable.
                                        </p>
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="email" :value="__('Correo Electrónico')" required class="text-gray-700 dark:text-gray-300"/>
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="email" type="email" wire:model="email" class="lowercase w-full" placeholder="usuario@dominio.com" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            {{-- BLOQUE 3: DOCUMENTACIÓN DIGITAL (FOTO Y FIRMA LADO A LADO EN GRID) --}}
                            <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Documentación Digital
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                                    <div class="w-full">
                                        <livewire:usuarios.upload-foto :existingFoto="$currentFoto" />
                                    </div>
                                    <div class="w-full">
                                        <livewire:usuarios.upload-firma :existingFirma="$currentFirma" />
                                    </div>
                                </div>
                            </div>

                            {{-- BLOQUE 4: CONTROL DE ESTADO --}}
                            <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40 transition-all duration-200 shadow-xs">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        
                                        <div class="flex items-center gap-3.5">
                                            <div class="h-9 w-9 rounded-lg bg-white dark:bg-gray-900 shadow-xs flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-gray-200 dark:border-gray-800 transition-colors">
                                                <i class="fa-solid fa-user-shield text-sm"></i>
                                            </div>
                                            <div>
                                                <h4 class="text-xs font-bold text-gray-900 dark:text-white transition-colors">Estado de la Cuenta</h4>
                                                <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5 transition-colors">¿Habilitar el acceso inmediato al sistema tras el registro?</p>
                                            </div>
                                        </div>

                                        <label class="relative inline-flex items-center cursor-pointer select-none">
                                            <input type="checkbox" wire:model="is_activo" class="sr-only peer">
                                            
                                            <div class="w-11 h-6 bg-gray-200 dark:bg-gray-800 rounded-full border border-transparent dark:border-gray-700 peer peer-checked:bg-indigo-600 dark:peer-checked:bg-indigo-500 transition-all duration-200
                                                after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 dark:after:border-transparent after:border after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-5 shadow-xs">
                                            </div>
                                            
                                            <span class="ml-3 text-[10px] font-extrabold uppercase tracking-widest transition-colors {{ $is_activo ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-400 dark:text-gray-500' }}">
                                                {{ $is_activo ? 'Habilitada' : 'Deshabilitada' }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Botonera inferior --}}
                        <x-slot:footer>
                            <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-6 w-full">
                                <div class="w-full sm:w-auto">
                                    @if(checkPermiso('usuarios.is_delete'))
                                        <button type="button" wire:click="confirmPermanentDelete" class="w-full sm:w-auto inline-flex items-center justify-center px-4 h-11 rounded-xl bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-400 border border-red-100 dark:border-red-500/20 text-xs font-bold uppercase tracking-wider hover:bg-red-600 hover:text-white transition-all duration-250 shadow-xs">
                                            <i class="fa-solid fa-trash-can mr-2"></i> Eliminar Nodo
                                        </button>
                                    @endif
                                </div>

                                <div class="w-full sm:w-auto">
                                    <x-shared::form.button-primary type="submit" class="w-full sm:w-auto justify-center shadow-lg shadow-indigo-500/10 px-5 h-11 text-xs" wire:loading.attr="disabled">
                                        <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                                        <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i>
                                        <span>Guardar Cambios</span>
                                    </x-shared::form.button-primary>
                                </div>
                            </div>
                        </x-slot:footer>
                    </x-shared::common.component-card>
                </div>

                {{-- Columna Derecha: Roles/Perfiles de Seguridad (5 Columnas) --}}
                <div class="lg:col-span-5">
                    <x-shared::common.component-card 
                        title="Perfiles de Seguridad" 
                        desc="Define los módulos y acciones permitidas para este usuario en el ecosistema."
                        class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="max-h-[620px] overflow-y-auto custom-scrollbar pr-1 space-y-3 py-1">
                            @foreach($perfilesCatalogo as $perfil)
                                <label class="relative flex items-center p-4 cursor-pointer rounded-xl border border-gray-100 dark:border-gray-850 bg-white dark:bg-gray-900/40 hover:border-indigo-500 dark:hover:border-indigo-550 transition-all group shadow-xs" wire:key="perfil-item-{{ $perfil->id }}">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" wire:model="selectedPerfiles" value="{{ $perfil->id }}" class="h-5 w-5 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500/10 dark:bg-gray-950 transition-colors">
                                    </div>
                                    <div class="ml-4">
                                        <span class="block font-bold text-xs text-gray-800 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $perfil->nombre }}
                                        </span>
                                        <span class="block text-[11px] text-gray-400 dark:text-gray-500 font-semibold transition-colors uppercase tracking-tight mt-0.5">
                                            {{ $perfil->descripcion ?: 'Acceso estándar al módulo' }}
                                        </span>
                                    </div>
                                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-30 transition-opacity">
                                        <i class="fa-solid fa-shield-halved text-indigo-600 text-xs"></i>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </x-shared::common.component-card>
                </div>

            </div>
        </form>
    </div>
</div>