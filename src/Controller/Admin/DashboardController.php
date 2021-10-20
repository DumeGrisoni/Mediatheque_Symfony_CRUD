<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Entity\Inscrit;
use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $livres= $em->getRepository(Livre::class)->findAll();
        // Recherche les livres qui ont plus de 2 jours sans être confirmés
        // On les retire à l'inscrit et on le remet disponible au Catalogue
        foreach ($livres as $book) {
                if ($book->getDisponible() == false){

                    $dateDelai = $book->getDateEmprunt()->format('y-m-d'); //18 en lettre format y-m-d (BDD)

                    //Ajout d'un flash message si + 21 jours
                    $diff = $book->getDateEmprunt()->diff($book->getDateRetour());
                    if ($diff->days > 21){
                        $this->addFlash('error', 'Vous avez des livres non rendus');
                    }

                    //Retrait du livre apres 2 jours
                    // Si on est le 18
                    $dateEmprunt = new \DateTime($dateDelai); //18 en DateTime
                    $delai = $dateEmprunt->add(new \DateInterval('P2D'));//20 en Datetime (18+2)
                    $now = new \DateTime('now'); //18 en Datetime

                    //Si on est le 24 alors 18+2 < 24 return True
                    if ($delai < $now && $book->getConfirme() ==false){
                        $book->setDisponible(true);
                        $book->setInscrit(NULL);
                        $em->flush();
                    }
                }
        }

        //Ajout d'une notification si un Inscrit s'est inscrit
        $inscrits = $em->getRepository(Inscrit::class)->findAll();
        foreach ($inscrits as $inscrit){
            $role = $inscrit->getRoles();
        }
        if ($role = 'ROLE_ATTENTE'){
            $this->addFlash('notice', "De nouveaux inscrits sont arrivés");
        }
        return $this->render('admin/dashboard.html.twig', [
            'livres' => $livres
        ]);
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mediathèque de la Chappel-Curreaux');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/images/style.css');
    }
    public function configureCrud(): Crud
    {
        return parent::configureCrud();
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Emprunts en cours', "fas fa-exchange-alt");
        yield MenuItem::linkToRoute('Catalogue', 'fas fa-book-reader', 'catalogue');
        yield MenuItem::linkToCrud('Inscriptions', 'fas fa-user-plus', Inscrit::class);
         yield MenuItem::linkToCrud('Employés', 'fas fa-users', Employe::class)->setPermission('ROLE_ADMIN');
         yield MenuItem::linkToCrud('Livres', 'fas fa-book', Livre::class);
    }
}
