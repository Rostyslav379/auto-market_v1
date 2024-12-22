<?php

namespace App\Service;

use App\Document\Car;
use App\Document\User;
use App\DTO\CarCreateUpdateDTO;
use App\DTO\CarDTO;
use App\DTO\CarListDTO;
use App\DTO\CarLIstItemDTO;
use App\Repository\CarRepository;
use App\Repository\MarkRepository;
use App\Repository\ModelRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

class CarService
{
    public function __construct(
        private readonly CarRepository $carRepository,
        private readonly ModelRepository $modelRepository,
        private readonly MarkRepository $markRepository,
        private readonly Security $security,
        private readonly UserRepository $userRepository,
    )
    {
    }

    public function getCars(string $page): CarListDTO
    {
        $dtos = [];

        foreach ($this->carRepository->finAllCars($page) as $car) {
            $dtos[] = new CarLIstItemDTO(
                id:  $car->getId(),
                mark: $car->getMark()->getMark(),
                model: $car->getModel()->getModel(),
                releaseYear: $car->getRealiseYear(),
                image: $car->getImage(),
                race: $car->getRace(),
                cost: $car->getCost(),
                address: $car->getAddress(),
            );
        }

        return new CarListDTO($dtos);
    }


    public function getCarsByMark(string $markId, string $page): CarListDTO
    {
        $dtos = [];

        foreach ($this->carRepository->finAllCars($page,['mark' => $this->markRepository->findMarkById($markId)]) as $car) {
            $dtos[] = new CarLIstItemDTO(
                id:  $car->getId(),
                mark: $car->getMark()->getMark(),
                model: $car->getModel()->getModel(),
                releaseYear: $car->getRealiseYear(),
                image: $car->getImage(),
                race: $car->getRace(),
                cost: $car->getCost(),
                address: $car->getAddress(),
            );
        }

        return new CarListDTO($dtos);
    }

    public function getCarsByMarkAndModel(string $markId, string $modelId, string $page): CarListDTO
    {
        $dtos = [];
        $criteria = ['mark' => $this->markRepository->findMarkById($markId), 'model' => $this->modelRepository->findModelById($modelId)];
        foreach ($this->carRepository->finAllCars($page, $criteria) as $car) {
            $dtos[] = new CarLIstItemDTO(
                id:  $car->getId(),
                mark: $car->getMark()->getMark(),
                model: $car->getModel()->getModel(),
                releaseYear: $car->getRealiseYear(),
                image: $car->getImage(),
                race: $car->getRace(),
                cost: $car->getCost(),
                address: $car->getAddress(),
            );
        }

        return new CarListDTO($dtos);
    }


    public function getCarsByUser(string $userId, string $page): CarListDTO
    {
        $dtos = [];
        $criteria = ['user' => $this->userRepository->findUserById($userId)];
        foreach ($this->carRepository->finAllCars($page, $criteria) as $car) {
            $dtos[] = new CarLIstItemDTO(
                id:  $car->getId(),
                mark: $car->getMark()->getMark(),
                model: $car->getModel()->getModel(),
                releaseYear: $car->getRealiseYear(),
                image: $car->getImage(),
                race: $car->getRace(),
                cost: $car->getCost(),
                address: $car->getAddress(),
            );
        }
        return new CarListDTO($dtos);
    }

    public function getCarById(string $id): CarDTO
    {
         $car = $this->carRepository->findCarById($id);

         return new CarDTO(
             id: $car->getId(),
             name: $car->getName(),
             race: $car->getRace(),
             releaseYear: $car->getRealiseYear(),
             mark: $car->getMark()->getMark(),
             model: $car->getModel()->getModel(),
             ownerName: $car->getUser()->getUsername(),
             ownerPhone: $car->getUser()->getPhone(),
             ownerId: $car->getUser()->getId(),
             cost: $car->getCost(),
             image: $car->getImage(),
             address: $car->getAddress(),
             description: $car->getDescription(),
             publicDate: $car->getCreatedAt()->format('Y-m-d'),
         );
    }


    public function createCar(CarCreateUpdateDTO $carCreateUpdateDTO): ?string
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();
        $car = $this->carRepository->findCarByUserAndCarName($user,$carCreateUpdateDTO->getName());

        if ($car !== null) {
            return null;
        }

        $car = new Car(
            name: $carCreateUpdateDTO->getName(),
            race: $carCreateUpdateDTO->getRace(),
            realiseYear: $carCreateUpdateDTO->getReleaseYear(),
            mark: $this->markRepository->findMarkById($carCreateUpdateDTO->getMarkId()),
            model: $this->modelRepository->findModelById($carCreateUpdateDTO->getModelId()),
            user: $user,
            cost: $carCreateUpdateDTO->getCost(),
            image: $carCreateUpdateDTO->getImage(),
            address: $carCreateUpdateDTO->getAddress(),
            description: $carCreateUpdateDTO->getDescription()
        );

        $this->carRepository->getDocumentManager()->persist($car);
        $this->carRepository->getDocumentManager()->flush();

        return $car->getId();
    }


    public function updateCar(CarCreateUpdateDTO $carCreateUpdateDTO, string $carId): ?string
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();
        $car = $this->carRepository->findCarByUserAndCarId($user,$carId);

        if ($car === null) {
            return null;
        }

        $car->setName($carCreateUpdateDTO->getName());
        $car->setRace($carCreateUpdateDTO->getRace());
        $car->setRealiseYear($carCreateUpdateDTO->getReleaseYear());
        $car->setMark($this->markRepository->findMarkById($carCreateUpdateDTO->getMarkId()));
        $car->setModel($this->modelRepository->findModelById($carCreateUpdateDTO->getModelId()));
        $car->setCost($carCreateUpdateDTO->getCost());
        $car->setAddress($carCreateUpdateDTO->getAddress());
        $car->setDescription($carCreateUpdateDTO->getDescription());
        $car->setImage($carCreateUpdateDTO->getImage());

        $this->carRepository->getDocumentManager()->persist($car);
        $this->carRepository->getDocumentManager()->flush();

        return $car->getId();
    }

    public function deleteCar(string $carId): bool
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();
        $car = $this->carRepository->findCarByUserAndCarId($user,$carId);

        if ($car === null) {
            return false;
        }

        $this->carRepository->deleteCar($car);
        return true;
    }
}