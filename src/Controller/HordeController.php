<?php

namespace App\Controller;

use App\Entity\Horde;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HordeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }



    #[Route('/la-meute', name: 'app_horde')]
    public function index(): Response
    {

        $hordes = $this->entityManager->getRepository(Horde::class)->findAll();
       
        return $this->render('horde/index.html.twig',[
            'hordes' => $hordes
        ] );
    }
}
