<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Comments;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DogActivityController extends AbstractController
{

        private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }


    #[Route('/activités-avec-nos-chiens-nordiques', name: 'app_dog_activity')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        // $pagination = 1;

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

        return $this->render('dog_activity/index.html.twig', [
            'products' => $products,
            'commentsByProduct' => $commentsByProduct,
            // 'pagination' =>$pagination
        ]);
    }
    
     // $pagination = $paginator->paginate(
        //     $commentsRepository->paginationQuery(),
        //     $request->query->get('page', 1),
        //     1
        // );
    // #[Route('/updateCommentPageByProduct/{idProductUpdate}/{index}', name: 'reset_app_dog_activity')]
    // public function maMethode(int $idProductUpdate, int $index)
    // {
    //     $products = $this->entityManager->getRepository(Product::class)->findAll();
    //     $comments = $this->entityManager->getRepository(Comments::class)->findAll();

    //     $commentsByProduct = array();

    //     foreach ($products as $product) {
    //         $idProduct = $product->getId();
    //         $commentsId = array();
    //         $i = 1;
    //         foreach($comments as $comment) {
    //             if($comment->getActivity()->getId() == $idProduct && $comment->isIsValid()) {
    //                 array_push($commentsId, [$i++, $comment]);
    //             }
    //         }

    //         if($idProductUpdate == $idProduct)
    //             array_push($commentsByProduct, [$idProduct, $commentsId, $index]);
    //         else
    //             array_push($commentsByProduct, [$idProduct, $commentsId, 1]);
    //     }

    //     $data = ['message' => 'Ceci est une réponse JSON via AJAX ', $commentsByProduct];
    //     return new JsonResponse($data);
    // }
}
