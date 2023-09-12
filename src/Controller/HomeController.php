<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\GalleryLanding;
use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // $mail = new Mail();
                        // 1 a quelle adresse       2 a qui    3  sujet du mail         4   contenu  
        // $mail->send('sylvain.conesa@hotmail.fr', 'john doe', 'Mon premier mail', "Bonjour john, j'éspère que tu vas bien " );
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $images = $this->entityManager->getRepository(GalleryLanding::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'headers' => $headers,
            'images' => $images
        ]);
    }
}
