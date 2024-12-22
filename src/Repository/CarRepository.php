<?php

namespace App\Repository;

use App\Document\Car;
use App\Document\Mark;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;

class CarRepository extends DocumentRepository
{
    const CAR_PAGINATION_SIZE = 5;
    public function __construct(DocumentManager $dm, UnitOfWork $uow)
    {
        parent::__construct($dm, $uow, new ClassMetadata(Car::class));
    }

    public function findCarById(string $id): Car
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @return Car[]
     */
    public function finAllCars(int $page, array $criteria = []): array
    {
        return $this->findBy(
            criteria: $criteria,
            orderBy: ['createdAt' => -1],
            limit: self::CAR_PAGINATION_SIZE,
            offset: ($page - 1) * self::CAR_PAGINATION_SIZE
        );
    }

    public function getCountByUser(User $user): int
    {
        return $this->createQueryBuilder()
            ->field('user')->equals($user)
            ->count()
            ->getQuery()
            ->execute();
    }

    public function findCarByUserAndCarName(User $user, string $carName): ?Car
    {
        return $this->findOneBy(['user' => $user, 'name' => $carName]);
    }

    public function findCarByUserAndCarId(User $user, string $id): ?Car
    {
        return $this->findOneBy(['user' => $user, 'id' => $id]);
    }

    public function deleteCar(Car $car): void
    {
          $this->dm->remove($car);
          $this->dm->flush();
    }
}