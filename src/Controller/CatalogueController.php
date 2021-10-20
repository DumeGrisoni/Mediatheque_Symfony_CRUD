<?php

namespace App\Controller;


use App\Entity\Livre;
use App\Form\SearchLivreType;
use App\Repository\InscritRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CatalogueController extends AbstractController
{
    /**
     * @param LivreRepository $livreRepository
     * @param InscritRepository $inscritRepository
     * @param Request $request
     * @return Response
     * @Route("/catalogue", name="catalogue")
     */
    public function index(LivreRepository $livreRepository, InscritRepository $inscritRepository, Request $request): Response
    {
        //Pagination avec la page 1 comme defaut
        $page= $request->query->get('page', 1);
        //limite de livres par page
        $limit = 8;
        //Les livres a affichés
        $livres = $livreRepository->getPaginationLivre($page, $limit);
        //On recupere le nombre total de livre
        $total = $livreRepository->getTotalLivre();

        //Récupération des livres et inscrits
        $books = $livreRepository->findAll();
        $inscrits = $inscritRepository->findAll();
        $em =  $this->getDoctrine()->getManager();

        // Recherche les livres qui ont plus de 2 jours sans être confirmés
        // On les retire à l'inscrit et on le remet disponible au Catalogue
        foreach ($books as $emprunt) {
            if ($emprunt->getDisponible() == false){
                //Si on est le 18
                $dateDelai = $emprunt->getDateEmprunt()->format('y-m-d'); //18 en lettre format y-m-d (BDD)
                $dateEmprunt = new \DateTime($dateDelai); //18 en DateTime
                $delai = $dateEmprunt->add(new \DateInterval('P2D'));//20 en Datetime (18+2)
                $now = new \DateTime('now'); //18 en Datetime

                //Si on est le 24 alors 18+2 < 24 return True
                if ($delai < $now && $emprunt->getConfirme() ==false){
                    $emprunt->setDisponible(true);
                    $emprunt->setInscrit(NULL);
                    $em->flush();
                }
            }
        }

        // Ajout de la barre de recherche
        $form = $this->createForm(SearchLivreType::class);
        $search = $form->handleRequest($request);

        //verification du formulaire
        if ($form->isSubmitted() && $form->isValid()){
            // Recherche des livre qui correspondent au mot clé tapé
            $livres = $livreRepository->search($search->get('mots')->getData());
        }

        return $this->render('catalogue/index.html.twig', [
            'livres' => $livres,
            'total'=> $total,
            'form' => $form->createView(),
            'limit' => $limit,
            'page'=> $page
        ]);
    }

    /**
     * @param $id
     * @param LivreRepository $livreRepository
     * @param InscritRepository $inscritRepository
     * @return Response
     * @Route("/livre/{id}" , name="livre")
     */
    public function modal($id, LivreRepository $livreRepository, InscritRepository  $inscritRepository): Response
    {
        // Fonction qui display les details d'un livre
        $em = $this->getDoctrine()->getManager();
        $livre= $em->getRepository(Livre::class)->find($id);
        return $this->render('livre/index.html.twig', [
            'livre' => $livre
        ]);
    }

    /**
     * @Route("/emprunt/{id}", name="emprunt")
     */
    public function emprunterLivre(int $id, LivreRepository $repository, InscritRepository $inscritRepository): Response
    {
        // Fonction d'emprunt livre qui l'ajoute à un Inscrit si il est disponible


        //Récupération de l'utilisateur courant
        $em = $this->getDoctrine()->getManager();
        $emprunt = $repository->find($id);
        $currentUser = $this->getUser();
        $inscrit = $inscritRepository->find($currentUser);

        //Création de la date de retour en ajoutant 21 à la date de d'emprunt
        $date = new \DateTime('now');
        $date2 = new \DateTime('now');
        $dateRetour = $date2->add(new \DateInterval('P21D'));

        //Verification que le livre est bien disponible => Display d'un flash erreur
        if ($emprunt->getDisponible()== false && $emprunt->getConfirme() == false){
            $this->addFlash('error', "Le livre n'est pas disponible, réessayez plus tard, merci");
        }else{

            // Modification des infos du livre
            $emprunt->setDateEmprunt($date);
            $emprunt->setDateRetour($dateRetour);
            $emprunt->setDisponible(false);
            $emprunt->setConfirme(false);

            //Ajout du livre modifié à l'Inscrit avec un flash Success
            $inscrit->addLivre($emprunt);
            $em->flush();
            $this->addFlash('success', "Le livre est loué");
        }
        return $this->redirectToRoute('catalogue', [
            'id' => $emprunt->getId(),
        ]);
    }
}
