<?php

namespace App\Contexts\Security\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

// Imports exclusivos del contexto Security
use App\Contexts\Security\Presentation\Livewire\Auth\Login;
use App\Contexts\Security\Presentation\Livewire\Auth\ConfirmPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\VerifyEmailPrompt;
use App\Contexts\Security\Presentation\Livewire\Auth\ResetPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\UpdatePasswordForm;
use App\Contexts\Security\Presentation\Livewire\Auth\ForgotPassword;
use App\Contexts\Security\Presentation\Livewire\Auth\Register;
use App\Contexts\Security\Presentation\Livewire\Profile\EditProfilePage;
use App\Contexts\Security\Presentation\Livewire\Profile\UpdateProfileInformationForm;
use App\Contexts\Security\Presentation\Livewire\Profile\DeleteUserForm;
use App\Contexts\Security\Presentation\Livewire\Permisos\IndexPermisos;
use App\Contexts\Security\Presentation\Livewire\Permisos\EditPermiso;
use App\Contexts\Security\Presentation\Livewire\Permisos\CreatePermiso;
use App\Contexts\Security\Presentation\Livewire\Perfiles\IndexPerfiles;
use App\Contexts\Security\Presentation\Livewire\Perfiles\CreatePerfil;
use App\Contexts\Security\Presentation\Livewire\Perfiles\EditPerfil;

use App\Contexts\Security\Presentation\Livewire\Usuarios\IndexUsuarios;
use App\Contexts\Security\Presentation\Livewire\Usuarios\CreateUsuario;
use App\Contexts\Security\Presentation\Livewire\Usuarios\EditUsuario;
use App\Contexts\Security\Presentation\Livewire\Usuarios\UploadFoto;
use App\Contexts\Security\Presentation\Livewire\Usuarios\UploadFirma;

class SecurityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contexts\Security\Domain\Repositories\PermisoRepositoryInterface::class,
            \App\Contexts\Security\Infrastructure\Repositories\EloquentPermisoRepository::class
        );

        $this->app->bind(
            \App\Contexts\Security\Domain\Repositories\PerfilRepositoryInterface::class,
            \App\Contexts\Security\Infrastructure\Repositories\EloquentPerfilRepository::class
        );

        $this->app->bind(
            \App\Contexts\Security\Domain\Repositories\UserRepositoryInterface::class,
            \App\Contexts\Security\Infrastructure\Repositories\EloquentUserRepository::class
        );
    }

    public function boot(): void
    {
        View::addNamespace('security', __DIR__ . '/../Presentation/Views');

        Livewire::component('security.auth.login', Login::class);
        Livewire::component('security.auth.confirm-password', ConfirmPassword::class);
        Livewire::component('security.auth.verify-email-prompt', VerifyEmailPrompt::class);
        Livewire::component('security.auth.reset-password', ResetPassword::class);
        Livewire::component('security.auth.update-password-form', UpdatePasswordForm::class);
        Livewire::component('security.auth.forgot-password', ForgotPassword::class);
        Livewire::component('security.auth.register', Register::class);

        Livewire::component('security.profile.edit-profile-page', EditProfilePage::class);
        Livewire::component('security.profile.update-profile-information-form', UpdateProfileInformationForm::class);
        Livewire::component('security.profile.delete-user-form', DeleteUserForm::class);

        Livewire::component('security.permisos.index-permisos', IndexPermisos::class);
        Livewire::component('security.permisos.edit-permiso', EditPermiso::class);
        Livewire::component('security.permisos.create-permiso', CreatePermiso::class);

        Livewire::component('security.perfiles.index-perfiles', IndexPerfiles::class);
        Livewire::component('security.perfiles.create-perfil', CreatePerfil::class);
        Livewire::component('security.perfiles.edit-perfil', EditPerfil::class);

        Livewire::component('security.usuarios.index-usuarios', IndexUsuarios::class);
        Livewire::component('security.usuarios.create-usuario', CreateUsuario::class);
        Livewire::component('security.usuarios.edit-usuario', EditUsuario::class);
        Livewire::component('usuarios.upload-foto', UploadFoto::class);
        Livewire::component('usuarios.upload-firma', UploadFirma::class);
    }
}