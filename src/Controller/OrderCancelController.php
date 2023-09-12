<?php

namespace App\Controller;
use App\Entity\Order;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderCancelController extends AbstractController
{


    #[Route('/commande/erreur/{stripeSessionId}', name: 'app_order_cancel')]
    public function index(EntityManagerInterface $entityManager,$stripeSessionId): Response
    {

        
        $order = $entityManager->getRepository(Order::class)->findOneBy(['StripeSessionId' => $stripeSessionId]);

        if(!$order || $order->getUser() != $this->getUser()){
            return $this->redirectToRoute('app_home', [
                'order' => $order
            ]);
        }

        return $this->render('order_cancel/index.html.twig', [
            'order' => $order
        ]);
}
}