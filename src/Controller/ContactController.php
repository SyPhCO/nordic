<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/nous-contacter', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->addFlash('notice', "Merci de m'avoir contacté. Je vous répondrai dans les meilleurs délais.");

            $mail = new Mail();
                        // 1 a quelle adresse       2 a qui    3  sujet du mail         4   contenu  
            $mail->send('sylvain.conesa@hotmail.fr', 'Nordic Indiana', 'Vous avez recu une nouvelle demande de contact', "$form->getData()" );
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
