<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    #[Route('/get/user/{id}', name:'getUserById', methods: ['GET'])]
    public function getUserById($id, userRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
        $user = $userRepository->find($id);
        $data = $serializer->serialize($user, 'json', ['groups' => 'user:read']);
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/get/users', name:'app_user_get_all', methods: ['GET'])]
    public function getAllUsers(userRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
        $users = $userRepository->findAll();
        $data = $serializer->serialize($users, 'json', ['groups' => 'user:read']);
        return new JsonResponse($data, 200, [], true);
    }
    #[Route('/post/user', name:'updateUser', methods: ['POST'])]
    public function postUser($id, Request $request, userRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
        $request;
        $parameters = json_decode($request->getContent(), true);
        $user = new user();
        $user->setUsername($parameters['username']);
        $user->setEmail($parameters['email']);
        $user->setPassword($parameters['password']);
        $id = $userRepository->save($user);

        $json = json_encode(["id" => $id, "message" => "User updated"]);

        return new JsonResponse($json, 200, [], true);
        }

}
