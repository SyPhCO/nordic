<?php

namespace App\Controller;
use App\Entity\Product;
use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommentsController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
     }

     
    #[Route('/comments', name: 'app_comments')]
    public function index(): Response
    {
        $activity = $this->entityManager->getRepository(Product::class)->findAll();

        $products = $this->entityManager->getRepository(Product::class)->findAll();
        $comments = $this->entityManager->getRepository(Comments::class)->findAll();
        $commentsRepository = $this->entityManager->getRepository(Comments::class);

        $commentsByProduct = array();


        foreach ($products as $product) {
            $idProduct = $product->getId();
            $commentsId = array();
            $i = 1;
            foreach($comments as $comment) {
                if($comment->getActivity()->getId() == $idProduct && $comment->isIsValid()) {
                    array_push($commentsId, [$i++, $comment]);
                }
            }
            array_push($commentsByProduct, [$idProduct, $commentsId, 1]);
        }

        return $this->render('comments/index.html.twig', [
            'products' => $products,
            'commentsByProduct' => $commentsByProduct,
            'comments' => $comments,
            'activity' => $activity

        ]);
    }
}
