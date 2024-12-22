<?php

namespace App\Repository;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;

class UserRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm, UnitOfWork $uow)
    {
        parent::__construct($dm, $uow, new ClassMetadata(User::class));
    }

    public function findUserById(string $id): User
    {
        return  $this->findOneBy(['_id' => $id]);
    }

    public function findUserByEmail(string $email): ?User
    {
        return  $this->findOneBy(['email' => $email]);
    }

    public function findOneById(string $id): ?User
    {
        $result = $this->find($id);
        return $result instanceof User ? null : $result;
    }

    public function save(User $user): void
    {
        $this->dm->persist($user);
        $this->dm->flush();
    }
}