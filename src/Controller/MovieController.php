<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }


    #[Route('/instant-nature', name: 'app_movie')]
    public function index(): Response
    {

        $movies = $this->entityManager->getRepository(Movie::class)->findAll();

        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
            'movies' => $movies
        ]);
    }
}
