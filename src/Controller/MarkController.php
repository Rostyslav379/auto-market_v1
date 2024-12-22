<?php

namespace App\Controller;

use App\Document\Mark;
use App\DTO\CreateMarkDTO;
use App\Service\MarkService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MarkController extends AbstractController
{
    public function __construct(private readonly MarkService $markService)
    {
    }

    #[Route(path: '/api/v1/marks', name: 'api_v1_get_marks', methods: ['GET'])]
    public function marks(): JsonResponse
    {
        return $this->json($this->markService->getAllMarks());
    }

    #[Route(path: '/api/v1/marks', name: 'api_v1_create_marks', methods: ['POST'])]
    public function createMark(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $dto = $serializer->deserialize($request->getContent(), CreateMarkDTO::class, 'json');
        $this->markService->create($dto);
        return $this->json([]);
    }
}