<?php

namespace App\Controller;
use App\Entity\Product;
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
        $activity = $this->entityManager->getRepository(Product::class)->findAll();

        $partners = $this->entityManager->getRepository(Partner::class)->findAll();

        return $this->render('partners/index.html.twig', [
            'partners' => $partners,
            'activity' => $activity

        ]);
    }

    #[Route('/Partenaire/{slug}', name: 'app_partner')]
    public function show($slug): Response
    {
        $partners = $this->entityManager->getRepository(Partner::class)->findAll();
        $partner = $this->entityManager->getRepository(Partner::class)->findOneBySlug($slug);
        $activity = $this->entityManager->getRepository(Product::class)->findAll();

        if(!$partner){
            return $this->redirectToRoute('app_partners');
        }

        return $this->render('partners/show.html.twig', [
            'partner' => $partner,
            'partners' => $partners,
            'activity' => $activity,

        ]);
    }
}

