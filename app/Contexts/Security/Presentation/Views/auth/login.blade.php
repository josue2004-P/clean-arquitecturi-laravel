<div>
    <x-slot:title>Login</x-slot:title>
    <x-slot:titleCard>Iniciar Sesión</x-slot:titleCard>
    <x-slot:descripcionCard>Ingresa tu email y contraseña para iniciar sesión!</x-slot:descripcionCard>
    
    <form wire:submit="login">
        <div class="space-y-5">

            <!-- Email Input Group -->
            <div>
                <x-shared::form.input-label for="email" required :value="__('Email')" />
                <x-shared::form.text-input
                    type="email"
                    wire:model="email"
                    id="email"
                    placeholder="info@gmail.com"
                    required 
                    autofocus
                    autocomplete="username" 
                />
                <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password Input Group -->
            <div>
                <x-shared::form.input-label required for="password" :value="__('Password')" />
                <div class="relative">
                    <x-shared::form.text-input
                        wire:model="password"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="Ingresa tu contraseña"
                        required 
                        autocomplete="current-password"
                    />
                </div>
                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer select-none">
                    <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/20 dark:border-gray-700">
                    <span class="ml-2 text-xs text-gray-500 dark:text-gray-400 font-medium">Recordar sesión</span>
                </label>

                <x-shared::form.link href="{{ route('password.request') }}" >
                    ¿Olvidaste tu contraseña?
                </x-shared::form.link>
            </div>

            <!-- Submit Button -->
            <div>
                <x-shared::form.button-primary type="submit" wire:loading.attr="disabled" class="w-full justify-center shadow-lg shadow-indigo-500/10">
                    <span wire:loading.remove>Iniciar Sesión</span>
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin text-xs"></i> Verificando credenciales...
                    </span>
                </x-shared::form.button-primary>
            </div>
        </div>
    </form>
</div>