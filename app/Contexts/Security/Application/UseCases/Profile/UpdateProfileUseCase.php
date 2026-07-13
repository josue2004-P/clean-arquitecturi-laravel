<?php

namespace App\Contexts\Security\Application\UseCases\Profile;

use App\Contexts\Security\Domain\Repositories\UserRepositoryInterface;

class UpdateProfileUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId, array $currentUserData, array $newData): void
    {
        $newData['email'] = strtolower(trim($newData['email']));

        if ($newData['email'] !== $currentUserData['email']) {
            $newData['email_verified_at'] = null;
        }

        $perfilesActuales = isset($currentUserData['perfiles']) 
            ? collect($currentUserData['perfiles'])->pluck('id')->toArray()
            : [];

        $this->userRepository->update($userId, $newData, $perfilesActuales);
    }
}