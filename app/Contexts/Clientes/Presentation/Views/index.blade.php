{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div>
    <x-shared::form.table-filters 
        title="Control Comercial de Clientes"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('clientes.create')" {{-- Cambiar a clientes.create cuando exista --}}
    >
        <x-slot:filters>
            {{-- Espacio disponible para selectores o filtros extra del cliente si se requieren en el futuro --}}
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">ID</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Nombre Completo</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">CURP / RFC</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">NSS</th>
                        <th scope="col" class="px-6 py-4 text-end text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Precalificación</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estado Civil</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($clientes as $cliente)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-100 dark:divide-gray-800" wire:key="cliente-{{ $cliente->getId() }}">
                            
                            {{-- ID --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-l border-r border-gray-150 dark:border-gray-850">
                                {{ $cliente->getId() }}
                            </td>

                            {{-- Nombre Completo --}}
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">
                                    {{ $cliente->getNombreCompleto() }}
                                </div>
                            </td>

                            {{-- Identificaciones --}}
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-850 text-xs text-gray-500 dark:text-gray-400 font-medium">
                                <div class="block"><strong>CURP:</strong> {{ $cliente->getCurp() ?? 'N/A' }}</div>
                                <div class="block text-[10px] text-gray-400 mt-0.5"><strong>RFC:</strong> {{ $cliente->getRfc() ?? 'N/A' }}</div>
                            </td>

                            {{-- NSS --}}
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850 text-sm font-semibold text-gray-600 dark:text-gray-300">
                                {{ $cliente->getNss() ?? 'N/A' }}
                            </td>

                            {{-- Precalificación --}}
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850 text-end font-mono text-sm font-bold text-gray-900 dark:text-white">
                                ${{ number_format($cliente->getPrecalificacion(), 2) }}
                            </td>

                            {{-- Estado Civil --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-none text-xs font-bold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                                    {{ str_replace('_', ' ', $cliente->getEstadoCivil() ?? 'No especificado') }}
                                </span>
                            </td>

                            {{-- Acciones --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('clientes.edit', $cliente->getId()) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </a>
                                    <button type="button" wire:click="confirmDelete({{ $cliente->getId() }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-trash-can text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 shadow-xs">
                                        <i class="fa-solid fa-users-slash text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight">Sin Clientes</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No se encontraron clientes registrados en el sistema.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-shared::form.table-filters>
</div>