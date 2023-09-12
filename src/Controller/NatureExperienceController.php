<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NatureExperienceController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
       $this->entityManager = $entityManager;
    }



    #[Route('/expérience-nature', name: 'app_nature_experience')]
    public function index( Request $request, PaginatorInterface $paginator): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        // $comments = $this->entityManager->getRepository(Comments::class)->findAll();

        $commentsRepository = $this->entityManager->getRepository(Comments::class);

        $pagination = $paginator->paginate(
            $commentsRepository->paginationQuery(),
            $request->query->get('page', 1),
            1
        );


        return $this->render('nature_experience/index.html.twig', [
            'products' => $products,
            // 'comments' => $comments,
            'pagination' =>$pagination

        ]);
    }
}
