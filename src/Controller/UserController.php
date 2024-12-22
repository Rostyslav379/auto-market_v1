<?php

namespace App\Controller;

use App\Document\User;
use App\DTO\RegistrationDTO;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }
    #[Route(path: '/api/v1/about-me-info', name: 'about_me_info', methods: ['GET'])]
    public function aboutMeInfo(Security $security): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = $security->getUser();
        return  $this->json($this->userService->getOwnerInfoById($user->getId()));
    }

    #[Route(path: '/api/v1/user-info-by-id/{id}', name: 'user_info_by_id', methods: ['GET'])]
    public function infoById(string $id): JsonResponse
    {
        return  $this->json($this->userService->getOwnerInfoById($id));
    }

    #[Route(path: '/api/registration',methods: ['POST'])]
    public function registration(Request $request, SerializerInterface $serializer): JsonResponse
    {
         $dto = $serializer->deserialize($request->getContent(), RegistrationDTO::class, 'json');

         $token = $this->userService->registration($dto);
         if ($token === null) {
             return new JsonResponse([],400);
         }
         return $this->json(['token' => $token]);
    }
}