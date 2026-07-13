<?php

namespace App\Contexts\Public\Presentation\Livewire;

use Livewire\Component;
use App\Contexts\Public\Application\UseCases\Contact\SubmitContactMessageUseCase;

class ContactPage extends Component
{
    public string $nombre = '';
    public string $email = '';
    public string $mensaje = '';

    public function submitContact(SubmitContactMessageUseCase $useCase)
    {
        $validated = $this->validate([
            'nombre'  => 'required|string|max:100',
            'email'   => 'required|email',
            'mensaje' => 'required|string|max:1000',
        ]);

        $useCase->execute($validated);

        $this->reset(['nombre', 'email', 'mensaje']);

        session()->flash('success', 'Mensaje enviado correctamente.');
    }

    public function render()
    {
        return view('public::contact-page')
            ->layout('shared::layouts.main')
            ->title('Contacto');
    }
}