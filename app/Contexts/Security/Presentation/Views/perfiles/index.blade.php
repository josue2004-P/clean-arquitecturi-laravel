{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div>
    <x-shared::form.table-filters 
        title="Jerarquía de Accesos"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('perfiles.create')"
    >
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        {{-- CONTENEDOR EXTERIOR CON BORDES TOTALMENTE CUADRADOS (ROUNDED-NONE) --}}
        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    {{-- DIVISIONES VERTICALES Y HORIZONTALES EN EL TR DE LA CABECERA --}}
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">ID</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Perfil del Sistema</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Alcance / Descripción</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Usuarios</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                {{-- TABLA INTERNA CON DIVIDE-Y PARA AGREGAR LA DIVISIÓN HORIZONTAL ENTRE CAMPOS/FILAS --}}
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($perfiles as $perfil)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-100 dark:divide-gray-800" wire:key="perfil-{{ $perfil->id }}">
                            
                            {{-- ID --}}
                            <td class="px-6 py-4 text-sm font-mono text-gray-400 dark:text-gray-500 transition-colors border-l border-r border-gray-150 dark:border-gray-850">
                                <span class="opacity-50">#</span>{{ str_pad($perfil->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            {{-- Perfil del Sistema --}}
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-2xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 dark:text-gray-500 mr-4 border border-gray-200 dark:border-gray-800 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-500 group-hover:border-transparent transition-all duration-300 shadow-xs">
                                        <i class="fa-solid fa-shield-halved text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight transition-colors group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                            {{ $perfil->nombre }}
                                        </div>
                                        <div class="text-[10px] font-extrabold text-gray-400 dark:text-gray-500 uppercase tracking-widest mt-0.5 transition-colors">
                                            Rol de Seguridad
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Alcance / Descripción --}}
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate font-medium transition-colors">
                                    {{ $perfil->descripcion ?: 'Sin descripción funcional definida' }}
                                </div>
                            </td>
                            
                            {{-- Usuarios --}}
                            <td class="px-6 py-4 text-center border-l border-r border-gray-150 dark:border-gray-850">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-50 text-gray-600 dark:bg-gray-900 dark:text-gray-400 border border-transparent dark:border-gray-800/60 transition-colors">
                                    <i class="fa-solid fa-users text-[10px] mr-1.5 text-gray-400 dark:text-gray-500"></i>
                                    {{ $perfil->usuarios_count ?? 0 }}
                                </span>
                            </td>
                            
                            {{-- Acciones (Dropdown con Teleport) --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 border-l border-r border-gray-150 dark:border-gray-850">
                                <div x-data="{ 
                                    dropdownOpen: false, 
                                    position: { top: 0, left: 0 },
                                    toggle(e) {
                                        this.dropdownOpen = !this.dropdownOpen;
                                        if (this.dropdownOpen) {
                                            let rect = e.currentTarget.getBoundingClientRect();
                                            this.position.top = rect.bottom + window.scrollY + 8;
                                            this.position.left = rect.right - 208 + window.scrollX;
                                        }
                                    }
                                }" 
                                class="inline-block text-left">
                                    
                                    <button 
                                        @click="toggle($event)" 
                                        class="p-2.5 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all border border-transparent hover:border-indigo-100 dark:hover:border-indigo-500/20 shadow-xs"
                                    >
                                        <i class="fa-solid fa-ellipsis-vertical text-base"></i>
                                    </button>

                                    <template x-teleport="body">
                                        <div 
                                            x-show="dropdownOpen" 
                                            @click.away="dropdownOpen = false"
                                            x-cloak
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            :style="`position: absolute; top: ${position.top}px; left: ${position.left}px;`"
                                            class="z-[200] w-52 rounded-2xl border border-gray-200 bg-white/95 dark:border-gray-800 dark:bg-gray-950 shadow-xl dark:shadow-2xl p-1.5 backdrop-blur-md"
                                        >
                                            <div class="px-3 py-2 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest border-b border-gray-100 dark:border-gray-850 mb-1.5 text-left transition-colors">
                                                Infraestructura
                                            </div>
                                            <div class="space-y-0.5 text-left">
                                                <a href="{{ route('perfiles.edit', $perfil->id) }}" class="flex items-center px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl transition-colors group/item">
                                                    <i class="fa-solid fa-gears mr-3 text-sm text-gray-400 dark:text-gray-500 group-hover/item:text-indigo-500 dark:group-hover/item:text-indigo-400 transition-colors"></i>Configurar Matriz
                                                </a>
                                                
                                                <div class="my-1 border-t border-gray-100 dark:border-gray-850"></div>
                                                
                                                <button 
                                                    wire:click="confirmDelete({{ $perfil->id }})" 
                                                    class="flex w-full items-center px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-colors group/del"
                                                >
                                                    <i class="fa-solid fa-trash-can mr-3 text-sm text-red-400 dark:text-red-500 transition-colors"></i>Eliminar Perfil
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-shield-slash text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Perfiles de Acceso</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 transition-colors">
                                        No hay roles registrados o que coincidan con los criterios de búsqueda actuales.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($perfiles->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $perfiles->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>