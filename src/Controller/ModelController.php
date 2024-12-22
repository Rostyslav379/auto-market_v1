<?php

namespace App\Controller;

use App\DTO\CreateMarkDTO;
use App\DTO\CreateModelDTO;
use App\Service\ModelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ModelController extends AbstractController
{
    public function __construct(private readonly ModelService $modelService)
    {
    }

    #[Route('/api/v1/models', name: 'api_v1_get_models', methods: ['GET'])]
    public function models(): JsonResponse
    {
        return $this->json($this->modelService->getAllModels());
    }

    #[Route(path: '/api/v1/models', name: 'api_v1_create_models', methods: ['POST'])]
    public function createModel(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $dto = $serializer->deserialize($request->getContent(), CreateModelDTO::class, 'json');
        $this->modelService->create($dto);
        return $this->json([]);
    }
}