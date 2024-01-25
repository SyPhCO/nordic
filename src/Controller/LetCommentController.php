<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Comments;
use App\Form\CommentsType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class LetCommentController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/laissez-votre-commentaire', name: 'app_let_comment')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $notification = null;
        $activity = $this->entityManager->getRepository(Product::class)->findAll();
        $comments = new Comments();
        $form = $this->createForm(CommentsType::class, $comments);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $picture = $form->get('illustration')->getData();
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $picture->guessExtension();

            try {
                $picture->move(
                    $this->getParameter('comments_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $comments->setIllustration($newFilename);
            $comments = $form->getData(); 
            $comments->setCreatedAt(new DateTimeImmutable());
            $this->entityManager->persist($comments);
            $this->entityManager->flush();
            $notification =  "Merci de votre retour d'expérience, j'éspère celle-ci vous as été agréable .
            Avant publication je me dois de vérifier chaque commentaire pour validation ( afin de ne pas retrouver de propos offensant ou insultant sur mon site qui se veux familial et jovial ).";
        }

        return $this->render('let_comment/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
            'activity' => $activity
        ]);
    }
}
