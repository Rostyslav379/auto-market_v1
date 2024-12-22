<?php

namespace App\Controller;

use App\DTO\CarCreateUpdateDTO;
use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CarController extends AbstractController
{
    public function __construct(private readonly CarService $carService)
    {
    }

    #[Route(path: '/api/v1/cars/{page}', name: 'api_cars', methods: ['GET'])]
    public function cars(string $page): JsonResponse
    {
        return $this->json($this->carService->getCars($page));
    }

    #[Route(path: '/api/v1/cars/by-mark/{mark}/{page}', name: 'api_cars_mark', methods: ['GET'])]
    public function carsByMark(string $mark,string $page): JsonResponse
    {
        return $this->json($this->carService->getCarsByMark($mark,$page));
    }
    #[Route(path: '/api/v1/cars/by-mark-and-model/{mark}/{model}/{page}', name: 'api_cars_mark_model', methods: ['GET'])]
    public function carsByMarkAndModel(string $mark,string $model,string $page): JsonResponse
    {
        return $this->json($this->carService->getCarsByMarkAndModel($mark,$model,$page));
    }
    #[Route(path: '/api/v1/cars/by-user/{userId}/{page}', name: 'api_cars_user', methods: ['GET'])]
    public function carsByUser(string $userId, string $page): JsonResponse
    {
        return $this->json($this->carService->getCarsByUser($userId,$page));
    }
    #[Route(path: '/api/v1/cars/by-id/{id}', name: 'api_cars_id', methods: ['GET'])]
    public function carById(string $id): JsonResponse
    {
        return $this->json($this->carService->getCarById($id));
    }

    #[Route(path: '/api/v1/cars', name: 'api_cars_create', methods: ['POST'])]
    public function createCar(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $carDTO = $serializer->deserialize($request->getContent(), CarCreateUpdateDTO::class, 'json');

        $carId = $this->carService->createCar($carDTO);

        if ($carId === null){
            return $this->json([],400);
        }

        return $this->json(['id' => $carId]);
    }

    #[Route(path: '/api/v1/cars/update/{carId}', name: 'api_cars_update', methods: ['PUT'])]
    public function updateCar(Request $request, SerializerInterface $serializer, string $carId): JsonResponse
    {
        $carDTO = $serializer->deserialize($request->getContent(), CarCreateUpdateDTO::class, 'json');

        $carId = $this->carService->updateCar($carDTO,$carId);

        if ($carId === null){
            return $this->json([],400);
        }

        return $this->json(['id' => $carId]);
    }
    #[Route(path: '/api/v1/cars/delete/{carId}', name: 'api_cars_delete', methods: ['DELETE'])]
    public function deleteCar(string $carId): JsonResponse
    {
        if (!$this->carService->deleteCar($carId)){
            return $this->json([],400);
        }

        return  $this->json([]);
    }
}