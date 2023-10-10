<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request, EntityManagerInterface $entityManager)
    {
        // Récupérer les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Valider les données, par exemple, vérifier si tous les champs nécessaires sont présents

        // Créer un nouvel utilisateur
        $user = new User();
        $user->setUsername($data['username']);
        $user->setSurname($data['surname']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $this->entityManager = $entityManager;
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Inscription réussie'], 201);
    }
}
