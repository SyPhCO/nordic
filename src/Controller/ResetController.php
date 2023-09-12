<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResetController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }

    #[Route('/updateCommentPageByProduct/{idProductUpdate}/{index}', name: 'reset_app_dog_activity')]
    public function maMethode(int $idProductUpdate, int $index)
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $idProductUpdate]);
        
        //$products = $this->entityManager->getRepository(Product::class)->findAll();
        $comments = $this->entityManager->getRepository(Comments::class)->findAll();

        $commentsByProduct = array();
            $idProduct = $product->getId();
            $commentsId = array();
            $i = 1;
            foreach($comments as $comment) {
                if($comment->getActivity()->getId() == $idProduct && $comment->isIsValid()) {
                    array_push($commentsId, [$i++, $comment]);
                }
            }

            if($idProductUpdate == $idProduct)
                array_push($commentsByProduct, [$idProduct, $commentsId, $index]);
            else
                array_push($commentsByProduct, [$idProduct, $commentsId, 1]);

                // return new JsonResponse($this->renderView('dog_activity/_comments_list.html.twig', [
                //     'commentsByProduct' => $commentsByProduct,
                // ]));

        $data = ['message' => 'Ceci est une réponse JSON via AJAX ', $commentsByProduct];
        return new JsonResponse($data);
    }
}
