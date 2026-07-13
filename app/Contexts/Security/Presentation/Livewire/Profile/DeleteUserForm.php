<?php

namespace App\Contexts\Security\Presentation\Livewire\Profile;

use Livewire\Component;
use App\Contexts\Security\Application\UseCases\Profile\DestroyAccountUseCase;
use Illuminate\Support\Facades\Auth;

class DeleteUserForm extends Component
{
    public $password = '';
    public bool $confirmingUserDeletion = false; 

    public function confirmDeletion()
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->confirmingUserDeletion = true;
    }

    public function cancelDeletion()
    {
        $this->confirmingUserDeletion = false;
    }

    public function deleteAccount(DestroyAccountUseCase $useCase)
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        try {
            $userId = Auth::id();

            $useCase->execute($userId, $this->password);

            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            return $this->redirect('/', navigate: true);

        } catch (\InvalidArgumentException $e) {
            $this->addError('password', $e->getMessage());
        } catch (\Exception $e) {
            $this->addError('password', 'Ocurrió un error al intentar eliminar la cuenta.');
        }
    }

    public function render()
    {
        return view('security::profile.delete-user-form');
    }
}