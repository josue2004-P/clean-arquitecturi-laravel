{{-- CONTENEDOR RAÍZ SIN LÍMITE DE ANCHO PARA QUE EL HEADER SE DESPLIEGUE A TODO LO ANCHO --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Cabecera del módulo a todo lo ancho, alineado a la izquierda --}}
    <x-shared::common.header 
        title="Registrar Nuevo Usuario" 
        icon="fa-user-plus"
        desc="Configura los datos personales, credenciales de seguridad y archivos digitales del nuevo miembro."
        :breadcrumb="[
            ['label' => 'Usuarios', 'url' => route('usuarios.index')],
            ['label' => 'Nuevo Usuario', 'url' => null]
        ]"
    />

    {{-- CONTENEDOR LIMITADO (MAX-W-5XL) ALINEADO A LA IZQUIERDA (SIN mx-auto) --}}
    <div class="max-w-5xl text-left">
        {{-- Gestión reactiva mediante wire:submit --}}
        <form wire:submit="save" class="space-y-6">
            
            {{-- Mapeado al contenedor de tarjetas de Shared con bordes adaptativos --}}
            <x-shared::common.component-card 
                title="Información de Cuenta" 
                desc="Define los datos personales, nombre de usuario único y acceso inicial." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="space-y-8">
                    
                    {{-- SECCIÓN 1: DATOS PERSONALES --}}
                    <div>
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Datos Personales
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Nombre(s) --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="name" :value="__('Nombre(s)')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="name"
                                        type="text"
                                        wire:model="name"
                                        placeholder="Ej. Pedro"
                                        class="w-full font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Apellido Paterno --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="apellido_paterno" :value="__('Apellido Paterno')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="apellido_paterno"
                                        type="text"
                                        wire:model="apellido_paterno"
                                        placeholder="Ej. Picapiedra"
                                        class="w-full font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                            </div>

                            {{-- Apellido Materno --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="apellido_materno" :value="__('Apellido Materno')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="apellido_materno"
                                        type="text"
                                        wire:model="apellido_materno"
                                        placeholder="Ej. Mármol"
                                        class="w-full font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 2: CREDENCIALES DE ACCESO --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Identidad en Plataforma
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nombre de Usuario --}}
                            <div>
                                <x-shared::form.input-label for="usuario" :value="__('Nombre de Usuario')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="usuario"
                                        type="text"
                                        wire:model="usuario"
                                        placeholder="Ej. pedropicapiedra"
                                        class="w-full font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('usuario')" class="mt-2" />
                            </div>

                            {{-- Correo Electrónico --}}
                            <div>
                                <x-shared::form.input-label for="email" :value="__('Correo Electrónico')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="email"
                                        type="email"
                                        wire:model="email"
                                        class="lowercase w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500" 
                                        placeholder="usuario@dominio.com"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 3: ARCHIVOS DIGITALES --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Documentación Digital
                        </h3>
                        
                        {{-- Subcomponentes alineados en grid de dos columnas (lado a lado) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                            <div class="w-full">
                                <livewire:usuarios.upload-foto />
                            </div>
                            <div class="w-full">
                                <livewire:usuarios.upload-firma />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 4: SEGURIDAD Y ESTADO --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6 space-y-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            Seguridad & Privilegios
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Contraseña --}}
                            <div>
                                <x-shared::form.input-label for="password" :value="__('Contraseña Temporal')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        type="password"
                                        wire:model="password"
                                        id="password"
                                        placeholder="Mínimo 8 caracteres"
                                        class="w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            {{-- Confirmación --}}
                            <div>
                                <x-shared::form.input-label for="password_confirmation" :value="__('Confirmar Contraseña')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        type="password"
                                        wire:model="password_confirmation"
                                        id="password_confirmation"
                                        placeholder="Repite la contraseña"
                                        class="w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                            </div>
                        </div>

                        {{-- Bloque de Estado con Contraste Premium Adaptado --}}
                        <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40 transition-all duration-200 shadow-xs">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                
                                {{-- Icono y Texto --}}
                                <div class="flex items-center gap-3.5">
                                    <div class="h-9 w-9 rounded-lg bg-white dark:bg-gray-900 shadow-xs flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-gray-200 dark:border-gray-800 transition-colors">
                                        <i class="fa-solid fa-user-shield text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-900 dark:text-white transition-colors">
                                            Estado de la Cuenta
                                        </h4>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5 transition-colors">
                                            ¿Habilitar el acceso inmediato al sistema tras el registro?
                                        </p>
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

                {{-- Footer con alineación y contraste perfecto --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('usuarios.index') }}"
                            class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-555 dark:text-gray-400 dark:hover:text-red-400 transition-colors duration-150">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar Registro
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg shadow-indigo-500/10 dark:shadow-indigo-500/5 px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-user-check mr-2 text-sm" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2 text-sm" wire:loading></i>
                            <span>Crear y Guardar</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>

            </x-shared::common.component-card>
        </form>
    </div>
</div>