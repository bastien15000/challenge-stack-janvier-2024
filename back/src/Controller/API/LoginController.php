<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Services\JWTService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api/login', name: 'api_login')]
class LoginController extends AbstractController
{

    public function __construct (
        private readonly JWTService $JWTService
    ) {}

    #[Route('', name: '')]
    public function index(#[CurrentUser] ?User $user): Response
    {

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
                ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->JWTService->createJWT($user);

        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'role' => $user->getRoles(),
            'token' => $token,
        ]);
    }
}