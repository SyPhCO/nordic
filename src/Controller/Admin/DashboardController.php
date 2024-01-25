<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\Horde;
use App\Entity\Gallery;
use App\Entity\Partner;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Comments;
use App\Entity\Contact;
use App\Entity\GalleryLanding;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Nordic Indiana');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Activités', 'fas fa-tag', Product::class);
        yield MenuItem::linkToCrud('Meute', 'fa fa-dog', Horde::class);
        yield MenuItem::linkToCrud('Equipe', 'fa fa-person', Team::class);
        yield MenuItem::linkToCrud('Gallerie', 'fa fa-image', Gallery::class);
        yield MenuItem::linkToCrud('Gallerie première page', 'fa fa-image', GalleryLanding::class);
        yield MenuItem::linkToCrud('Partenaire', 'fa fa-handshake', Partner::class);
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-check', Comments::class);
        yield MenuItem::linkToCrud('Film', 'fa fa-video', Movie::class);
        yield MenuItem::linkToCrud('Email', 'fa fa-envelope', Contact::class);

    }
}
