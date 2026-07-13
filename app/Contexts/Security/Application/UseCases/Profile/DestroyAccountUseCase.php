<?php

namespace App\Contexts\Security\Application\UseCases\Profile;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

class DestroyAccountUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId, string $password): void
    {
        $userArray = $this->userRepository->findById($userId);

        if (!$userArray) {
            throw new \Exception("Usuario no encontrado.");
        }

        if (!password_verify($password, $userArray['password'])) {
            throw new \InvalidArgumentException("La contraseña proporcionada es incorrecta.");
        }

        $this->userRepository->delete($userId);
    }
}