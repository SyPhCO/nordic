<?php

namespace App\Controller;
use App\Entity\Product;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/nous-contacter', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager,MailerInterface $mailer): Response
    {
        $activity = $this->entityManager->getRepository(Product::class)->findAll();
        $notification = null;
        $contact = new Contact();
        if($this->getUser()) {
            $contact->setFirstname($this->getUser()->getFirstname())
            ->setLastname($this->getUser()->getLastname())
            ->setEmail($this->getUser()->getEmail());
        }

        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('nordicindiana@yahoo.fr')
            ->subject($contact->getSubject())
        ->htmlTemplate('contact/email.html.twig')
        ->context([
        'contact' => $contact
    ]);

        $mailer->send($email);

            $notification =  "Merci de m'avoir contacté. Je vous répondrai dans les meilleurs délais.";
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
            'activity' => $activity
        ]);
    }
}
