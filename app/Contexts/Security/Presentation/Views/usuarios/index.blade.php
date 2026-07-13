{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div>
    <x-shared::form.table-filters 
        title="Control de Usuarios"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('usuarios.create')"
    >
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-white/[0.02]">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">Personal</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">Credencial Digital</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">Roles Asignados</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">Estado</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-transparent">
                    {{-- 💡 CORREGIDO: Espacio añadido en 'as $user' --}}
                    @forelse($usuarios as $user)
                        <tr class="group hover:bg-slate-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200" wire:key="usuario-{{ $user->id }}">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 mr-4 border border-zinc-200 dark:border-zinc-700 group-hover:bg-zinc-900 group-hover:text-white transition-all duration-300">
                                        <i class="fa-solid fa-user-gear text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-gray-900 dark:text-white tracking-tight">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">
                                            Operador de Plataforma
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                    <i class="fa-solid fa-envelope text-[10px] opacity-40"></i>
                                    {{ $user->email }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5 max-w-xs">
                                    {{-- 💡 CORREGIDO: Espacio añadido en 'as $perfil' --}}
                                    @forelse($user->perfiles as $perfil)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20">
                                            {{ $perfil->nombre }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 dark:text-gray-500 italic flex items-center gap-1">
                                            <i class="fa-solid fa-user-shield opacity-40"></i> Sin perfiles activos
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($user->is_activo)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        Suspendido
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap z-30">
                                <div x-data="{ 
                                    dropdownOpen: false, 
                                    position: { top: 0, left: 0 },
                                    toggle(e) {
                                        this.dropdownOpen = !this.dropdownOpen;
                                        if (this.dropdownOpen) {
                                            let rect = e.currentTarget.getBoundingClientRect();
                                            // Calcula la posición absoluta sumando el scroll actual del documento
                                            this.position.top = rect.bottom + window.scrollY + 8;
                                            this.position.left = rect.right - 208 + window.scrollX; // 208px es el ancho w-52
                                        }
                                    }
                                }" 
                                class="inline-block text-left">
                                    
                                    {{-- Botón disparador --}}
                                    <button 
                                        @click="toggle($event)" 
                                        class="p-2.5 rounded-xl text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all border border-transparent hover:border-indigo-100 dark:hover:border-indigo-500/20"
                                    >
                                        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                    </button>

                                    {{-- Teletransportado al final del body para escapar del overflow de la tabla --}}
                                    <template x-teleport="body">
                                        <div 
                                            x-show="dropdownOpen" 
                                            @click.away="dropdownOpen = false"
                                            x-cloak
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            :style="`position: absolute; top: ${position.top}px; left: ${position.left}px;`"
                                            class="z-[200] w-52 rounded-2xl border border-gray-200 bg-white/95 backdrop-blur-md shadow-2xl dark:border-gray-700 dark:bg-gray-900/95 p-1.5"
                                        >
                                            <div class="px-3 py-2 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 dark:border-gray-800 mb-1.5 text-left">
                                                Administración
                                            </div>
                                            <div class="space-y-0.5 text-left">
                                                <a href="{{ route('usuarios.edit', $user->id) }}" class="flex items-center px-3 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl transition-colors group/item">
                                                    <i class="fa-solid fa-user-pen mr-3 text-gray-400 group-hover/item:text-indigo-500 transition-colors"></i>
                                                    Modificar Perfil
                                                </a>
                                                
                                                <div class="my-1 border-t border-gray-50 dark:border-gray-800"></div>
                                                
                                                <button 
                                                    wire:click="confirmDelete({{ $user->id }})" 
                                                    class="flex w-full items-center px-3 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-colors group/del"
                                                >
                                                    <i class="fa-solid fa-user-slash mr-3 text-red-400 group-hover/del:text-red-500 transition-colors"></i>
                                                    Dar de Baja
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
                                    <div class="h-20 w-20 bg-slate-50 dark:bg-white/[0.02] rounded-full flex items-center justify-center mb-4 border border-slate-100 dark:border-white/5">
                                        <i class="fa-solid fa-users-slash text-3xl text-slate-200 dark:text-slate-800"></i>
                                    </div>
                                    <h3 class="text-lg font-extrabold text-gray-900 dark:text-white uppercase tracking-tight">Sin Usuarios</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 italic">
                                        No hay operadores registrados o que coincidan con la búsqueda.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($usuarios->hasPages())
            <div class="px-6 py-5 bg-gray-50/30 dark:bg-transparent border-t border-gray-200 dark:border-gray-800">
                {{ $usuarios->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>