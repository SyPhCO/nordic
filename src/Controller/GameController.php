<?php

namespace App\Controller;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/jeux', name: 'app_game')]
    public function index(): Response
    {

        $activity = $this->entityManager->getRepository(Product::class)->findAll();

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'activity' => $activity

        ]);
    }
}
