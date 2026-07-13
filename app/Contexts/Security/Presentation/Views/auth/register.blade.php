<div>
    <x-slot:title>Registro de Operador</x-slot:title>
    <x-slot:titleCard>Crear Cuenta</x-slot:titleCard>
    <x-slot:descripcionCard>Regístrate para obtener tus credenciales de acceso técnico.</x-slot:descripcionCard>

    <form wire:submit="register">
        <div class="space-y-5">
            
            <div>
                <x-form.input-label for="name" :value="__('Nombre Completo')" required />
                <x-form.text-input 
                    id="name" 
                    type="text" 
                    wire:model="name" 
                    placeholder="Ej. Ing. Carlos Mendoza" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="email" :value="__('Correo Electrónico')" required />
                <x-form.text-input 
                    id="email" 
                    type="email" 
                    wire:model="email" 
                    placeholder="operador@dominio.com" 
                    required 
                    autocomplete="username" 
                />
                <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="password" :value="__('Contraseña de Acceso')" required />
                <x-form.text-input 
                    id="password" 
                    type="password" 
                    wire:model="password" 
                    placeholder="Mínimo 8 caracteres" 
                    required 
                    autocomplete="new-password" 
                />
                <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="password_confirmation" :value="__('Confirmar Contraseña')" required />
                <x-form.text-input 
                    id="password_confirmation" 
                    type="password" 
                    wire:model="password_confirmation" 
                    placeholder="Repite tu contraseña exactamente" 
                    required 
                    autocomplete="new-password" 
                />
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-gray-800">
                <a class="underline text-xs font-bold text-gray-400 hover:text-indigo-600 rounded-md transition-colors uppercase tracking-wider" href="{{ route('login') }}" >
                    {{ __('¿Ya tienes cuenta?') }}
                </a>

                <x-form.button-primary type="submit" wire:loading.attr="disabled" class="shadow-lg shadow-indigo-500/10">
                    <span wire:loading.remove><i class="fa-solid fa-user-plus mr-1.5"></i> Dar de Alta</span>
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin text-xs"></i> Creando credenciales...
                    </span>
                </x-form.button-primary>
            </div>
        </div>
    </form>
</div>