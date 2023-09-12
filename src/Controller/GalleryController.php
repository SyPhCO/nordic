<?php

namespace App\Controller;

use App\Entity\Gallery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalleryController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }


    #[Route('/galerie', name: 'app_gallery')]
    public function index(): Response
    {

        $images = $this->entityManager->getRepository(Gallery::class)->findAll();

        return $this->render('gallery/index.html.twig', [
            'images' => $images,
        ]);
    }
}
