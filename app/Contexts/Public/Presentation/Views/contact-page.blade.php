{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="space-y-8">
    
    <div class="text-center max-w-2xl mx-auto space-y-4">
        <h2 class="text-indigo-600 text-[10px] font-black uppercase tracking-[0.4em]">Canal Digital</h2>
        <h3 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter">
            Envía tu requerimiento <br>
            <span class="text-slate-400 font-light italic font-serif tracking-normal">patrimonial.</span>
        </h3>
    </div>

    {{-- Estado de alerta nativa estilizado --}}
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-sm shadow-sm max-w-xl mx-auto text-xs font-medium">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Formulario con arquitectura limpia y componentes compartidos --}}
    <form wire:submit="submitContact" class="relative bg-white p-10 lg:p-12 rounded-sm shadow-2xl border border-slate-100 space-y-8 max-w-xl mx-auto overflow-hidden">
        
        {{-- Decoración técnica consistente --}}
        <div class="absolute top-0 right-0 p-4 font-mono text-[8px] text-slate-200 uppercase tracking-widest select-none">
            Ref: WIRE_CONTACT_FORM
        </div>

        <!-- Campo: Nombre Completo -->
        <div>
            <x-shared::form.input-label for="nombre" required :value="__('Nombre Completo')" />
            <x-shared::form.text-input
                type="text"
                wire:model="nombre"
                id="nombre"
                placeholder="Ej. Carlos Mendoza"
                required
                autofocus
                :messages="$errors->get('nombre')"
            />
            <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Campo: Correo Electrónico -->
        <div>
            <x-shared::form.input-label for="email" required :value="__('Correo Electrónico')" />
            <x-shared::form.text-input
                type="email"
                wire:model="email"
                id="email"
                placeholder="carlos@ejemplo.com"
                required
                :messages="$errors->get('email')"
            />
            <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo: Mensaje / Detalles -->
        <div>
            <x-shared::form.input-label for="mensaje" required :value="__('Detalles del Requerimiento')" />
            <div class="relative">
                <textarea 
                    id="mensaje" 
                    wire:model="mensaje" 
                    rows="5" 
                    required
                    class="w-full bg-slate-50 border-0 border-b-2 {{ $errors->has('mensaje') ? 'border-red-300 text-error-600 focus:border-red-500' : 'border-slate-200 focus:border-indigo-600' }} focus:ring-0 transition-all py-3 px-0 text-slate-900 placeholder-slate-300 resize-none font-sans text-sm outline-none"
                    placeholder="Describa brevemente la propiedad de su interés, zona geográfica de búsqueda o el tipo de asesoría que requiere..."></textarea>
            </div>
            <x-shared::form.input-error :messages="$errors->get('mensaje')" class="mt-2" />
        </div>

        <!-- Botón de Envío Estilizado -->
        <div>
            <x-shared::form.button-primary type="submit" wire:loading.attr="disabled" class="w-full justify-center shadow-lg shadow-indigo-500/10 py-4 bg-[#0a0f1d] hover:bg-indigo-600 text-[10px] font-black uppercase tracking-[0.3em]">
                <span wire:loading.remove class="flex items-center gap-2">
                    Enviar Solicitud <i class="fas fa-paper-plane text-[9px]"></i>
                </span>
                <span wire:loading class="flex items-center gap-2">
                    <i class="fas fa-circle-notch animate-spin text-[9px]"></i> Procesando Enlace Comercial...
                </span>
            </x-shared::form.button-primary>
        </div>
    </form>
</div>