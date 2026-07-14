{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div>
    <x-shared::form.table-filters 
        title="Control de Ubicaciones"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('asentamientos.create')"
    >
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">C.P.</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Asentamiento / Colonia</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Municipio / Del.</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estado</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($asentamientos as $asentamiento)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-100 dark:divide-gray-800" wire:key="asentamiento-{{ $asentamiento->id }}">
                            
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm font-bold text-indigo-600 dark:text-indigo-400 border-l border-r border-gray-150 dark:border-gray-850">
                                {{ $asentamiento->codigo_postal }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $asentamiento->nombre_asentamiento }}</div>
                                <div class="text-[10px] font-extrabold text-gray-400 dark:text-gray-550 uppercase tracking-widest mt-0.5">{{ $asentamiento->tipo_asentamiento }}</div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600 dark:text-gray-300 border-l border-r border-gray-150 dark:border-gray-850">
                                {{ $asentamiento->municipio }} 
                                @if($asentamiento->ciudad) 
                                    <span class="text-xs text-gray-400 dark:text-gray-550 font-medium">({{ $asentamiento->ciudad }})</span> 
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700 dark:text-gray-400 border-l border-r border-gray-150 dark:border-gray-850">
                                {{ $asentamiento->estado }}
                            </td>
                            
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('asentamientos.edit', $asentamiento->id) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </a>
                                    
                                    {{-- Botón adaptado a tu flujo SweetAlert --}}
                                    <button type="button" wire:click="confirmDelete({{ $asentamiento->id }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-trash-can text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-earth-lines text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Asentamientos</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 transition-colors">No se encontraron ubicaciones geográficas bajo los parámetros ingresados.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($asentamientos->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $asentamientos->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>