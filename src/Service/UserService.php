<?php

namespace App\Service;

use App\Document\User;
use App\DTO\OwnerDTO;
use App\DTO\RegistrationDTO;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly CarRepository $carRepository,
        private JWTTokenManagerInterface $JWTTokenManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function getOwnerInfoById(string $id): OwnerDTO
    {
        $user = $this->userRepository->findUserById($id);
        return new OwnerDTO(
            id: $user->getId(),
            username: $user->getUsername(),
            registrationDate: $user->getCreatedAt()->format("Y-m-d"),
            phone: $user->getPhone(),
            carCount: $this->carRepository->getCountByUser($user)
        );
    }


    public function registration(RegistrationDTO $registrationDTO): ?string
    {
         $user = $this->userRepository->findUserByEmail($registrationDTO->getEmail());
         if ($user !== null) {
             return null;
         }

         $user = new User(
             email: $registrationDTO->getEmail(),
             username: $registrationDTO->getUsername(),
             phone: $registrationDTO->getPhone(),
         );
         $user->setRoles([User::ROLE_USER]);

         $user->setPassword($this->passwordHasher->hashPassword($user, $registrationDTO->getPassword()));

         $this->userRepository->save($user);

         return $this->JWTTokenManager->create($user);
    }
}