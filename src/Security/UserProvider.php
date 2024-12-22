<?php

namespace App\Security;


use App\Document\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function loadUserByUsername(string $username): UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $username]);
        if (null === $user) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $username));
        }
        return $user;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $identifier]) ?? $this->userRepository->findOneBy(['username' => $identifier]) ;
        if (null === $user) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        }
        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }
        $refreshedUser = $this->userRepository->findOneById($user->getId());
        if (null === $refreshedUser) {
            throw new UserNotFoundException(sprintf('User with id %s not found', $user->getId()));
        }
        return $refreshedUser;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}
