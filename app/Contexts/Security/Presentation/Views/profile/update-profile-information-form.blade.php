<section>
    <header>
        <h2 class="text-lg font-medium text-gray-700 dark:text-gray-400">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-800 dark:text-gray-500">
            {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfile" class="mt-6 space-y-6">
        <div>
            <x-form.input-label for="name" :value="__('Nombre:')" />
            <x-form.text-input
                type="text"
                id="name"
                placeholder="Escribe el nombre"
                wire:model="name"
            />    
            @error('name') <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-form.input-label for="email" :value="__('Email:')" />
            <x-form.text-input
                type="text"
                id="email"
                placeholder="Escribe el email"
                wire:model="email"
            />    
            @error('email') <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-form.button-primary type="submit">
                {{ __('Guardar') }}
            </x-form.button-primary>

            @if (session()->has('success'))
                <p class="text-sm text-green-600 dark:text-green-400 font-medium">
                    {{ session('success') }}
                </p>
            @endif
        </div>
    </form>
</section>