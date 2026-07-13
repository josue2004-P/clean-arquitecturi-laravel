<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <div class="h-12 w-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-600 border border-slate-200 dark:border-white/10 shadow-sm">
            <i class="fa-solid fa-shield-halved text-xl"></i>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Nuevo Perfil de Acceso</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Establece las bases para la jerarquía de permisos.</p>
        </div>
    </div>

    <form wire:submit="save">
        <x-shared::common.component-card title="Arquitectura del Rol" desc="El nombre debe ser único y descriptivo para facilitar la administración." class="shadow-theme-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="col-span-1">
                    <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required/>
                    <div class="mt-1 relative group">
                        <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" placeholder="ej: administrador, tecnico_lab" class="lowercase w-full font-mono text-indigo-600 dark:text-indigo-400"/>
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                
                <div class="col-span-1">
                    <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')" />
                    <div class="mt-1">
                        <x-shared::form.text-input id="descripcion" type="text" wire:model="descripcion" placeholder="Ej. Acceso total a reportes" class="w-full"/>
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>
            </div>
            
            <x-slot:footer>
                <div class="flex items-center justify-between">
                    <a href="{{ route('perfiles.index') }}" class="text-sm font-bold text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-xmark mr-2"></i> Cancelar
                    </a>
                    
                    <x-shared::form.button-primary type="submit" class="shadow-lg shadow-indigo-500/20" wire:loading.attr="disabled">
                        <i class="fa-solid fa-shield-check mr-2" wire:loading.remove></i>
                        <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                        <span>Registrar Perfil</span>
                    </x-shared::form.button-primary>
                </div>
            </x-slot:footer>
        </x-shared::common.component-card>
    </form>
</div>