@props([
    'disabled' => false,
    'messages' => [],
    'placeholder' => null
])

<div 
    class="relative w-full" 
    x-data="{ 
        isOptionSelected: false,
        init() {
            {{-- Evaluamos al cargar el DOM si el select ya tiene un valor válido seleccionado --}}
            this.isOptionSelected = $refs.selectElement.value !== '';
        }
    }"
>
    <select
        x-ref="selectElement"
        @disabled($disabled)
        @change="isOptionSelected = ($event.target.value !== '')"
        {{ $attributes->merge([
            'class' => "
                w-full h-11 px-4 py-2.5 pr-11 text-sm rounded-none border appearance-none 
                focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-colors duration-200
                dark:bg-gray-950 dark:border-gray-800
                " . ($messages 
                        ? 'border-red-500 text-red-650 dark:border-red-800 dark:text-red-400 focus:border-red-500 focus:ring-red-500/10' 
                        : 'border-gray-200 dark:border-gray-800'
                    )
        ]) }}
        {{-- Sincronización dinámica del color según la selección del placeholder --}}
        :class="isOptionSelected ? 'text-gray-900 dark:text-gray-100 font-medium' : 'text-gray-450 dark:text-white/20 font-normal'"
    >
        {{-- Si se pasó un string placeholder, renderizamos la opción por defecto --}}
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        {{ $slot }}
    </select>

    {{-- Contenedor de iconos alineados a la derecha --}}
    <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none gap-2">
        {{-- Icono de error --}}
        @if ($messages)
            <svg class="flex-shrink-0 text-red-500 dark:text-red-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                    fill="currentColor" />
            </svg>
        @endif

        {{-- Icono flecha nativo --}}
        <svg class="stroke-current text-gray-400 dark:text-gray-500" width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
</div>