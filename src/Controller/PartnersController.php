<?php

namespace App\Controller;

use App\Entity\Partner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartnersController extends AbstractController
{

    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }

    #[Route('/partenaires', name: 'app_partners')]
    public function index(): Response
    {

        $partners = $this->entityManager->getRepository(Partner::class)->findAll();

        return $this->render('partners/index.html.twig', [
            'partners' => $partners,
        ]);
    }
}
