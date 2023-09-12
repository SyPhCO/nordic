<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
  
    
    #[Route('/commande/merci/{stripeSessionId}', name: 'app_order_validate')]
    public function index(EntityManagerInterface $entityManager,Cart $cart,$stripeSessionId): Response
    {

        
        $order = $entityManager->getRepository(Order::class)->findOneBy(['StripeSessionId' => $stripeSessionId]);

        if(!$order || $order->getUser() != $this->getUser()){
            return $this->redirectToRoute('app_home');
        }


        if ($order->getState() == 0){
             //modifier statut isPaid
            $cart->remove();

             $order->setState(1);
             $entityManager->flush();



        // envoyer un mail au client pour confirmer la commande
        $mail = new Mail();
                $content = "Bonjour".$order->getUser()->getFirstname()."<br/>Merci pour votre commande.<br/> <br/>Des événements thématiques vous seront régulièrement proposés. Pensez à suivre Nordic Indiana sur Facebook, pour découvrir notre actualité, et les surprises qui vous seront réservées au gré des saisons. <br/> Jérémy";
                $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande sur Nordic Indiana est bien validée', $content);

        }
       
        // afficher les queques infos de la commande de l'utilisateur



        return $this->render('order_success/index.html.twig', [
            'order' =>$order
        ]);
    }
}
