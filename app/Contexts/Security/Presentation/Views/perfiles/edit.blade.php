{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-3xl bg-slate-900 flex items-center justify-center text-white shadow-xl shadow-slate-200 dark:shadow-none">
                <i class="fa-solid fa-shield-halved text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Arquitectura de Accesos</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Definiendo capacidades para el perfil: <span class="font-bold text-indigo-600 uppercase tracking-wider">{{ $nombre }}</span></p>
            </div>
        </div>
        <a href="{{ route('perfiles.index') }}" class="group inline-flex items-center px-5 py-2.5 text-sm font-bold text-gray-500 hover:text-indigo-600">
            <i class="fa-solid fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i> Volver al listado
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 space-y-6">
                <x-shared::common.component-card title="Identidad del Rol" desc="Información administrativa del perfil.">
                    <div class="space-y-5">
                        <div>
                            <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required />
                            <x-shared::form.text-input type="text" wire:model="nombre" id="nombre" class="w-full font-mono font-bold text-indigo-600 dark:text-indigo-400 mt-1" />
                            <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                        <div>
                            <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')" />
                            <x-shared::form.text-input type="text" wire:model="descripcion" id="descripcion" class="w-full mt-1" />
                            <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>
                    </div>
                    <x-slot:footer>
                        <x-shared::form.button-primary type="submit" class="w-full !rounded-2xl shadow-lg shadow-indigo-500/20" wire:loading.attr="disabled">
                            <i class="fa-solid fa-shield-check mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Guardar Configuración</span>
                        </x-shared::form.button-primary>
                    </x-slot:footer>
                </x-shared::common.component-card>
            </div>

            <div class="lg:col-span-8">
                <x-shared::common.component-card title="Matriz de Permisos" desc="Concede acciones específicas para cada módulo del sistema.">
                    <div class="space-y-3">
                        @foreach($permisosCatalogo as $permiso)
                            <div class="rounded-3xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.01] hover:border-indigo-500/30 transition-all duration-300" wire:key="matriz-permiso-{{ $permiso['id'] }}">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 p-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-xl bg-white dark:bg-gray-900 flex items-center justify-center text-indigo-500 border border-gray-100 dark:border-gray-800 shadow-sm">
                                            <i class="fa-solid fa-cube text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-black text-sm text-gray-800 dark:text-gray-200 uppercase tracking-tight">{{ $permiso['nombre'] }}</p>
                                            <p class="text-[11px] text-gray-400 font-medium italic">{{ $permiso['descripcion'] }}</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2">
                                        @foreach(['is_read' => ['Leer', 'text-emerald-600', 'hover:border-emerald-500/50'], 'is_create' => ['Crear', 'text-blue-600', 'hover:border-blue-500/50'], 'is_update' => ['Editar', 'text-amber-600', 'hover:border-amber-500/50'], 'is_delete' => ['Eliminar', 'text-red-600', 'hover:border-red-500/50']] as $key => $estilo)
                                            <label class="flex items-center px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 cursor-pointer {{ $estilo[2] }} transition-all group">
                                                <input type="checkbox" wire:model="matriz.{{ $permiso['id'] }}.{{ $key }}" class="h-4 w-4 rounded border-gray-300 {{ $estilo[1] }} focus:ring-opacity-20">
                                                <span class="ml-2 text-[10px] font-extrabold uppercase tracking-widest text-gray-500 group-hover:{{ $estilo[1] }} transition-colors">{{ $estilo[0] }}</span>
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