<?php

namespace App\Controller;

use App\Repository\InscritRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace", name="espace_")
 */
class InscritController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * @param LivreRepository $livreRepository
     * @return Response
     */
    public function index(LivreRepository $livreRepository): Response
    {
        $livre = $livreRepository->findAll();
        foreach ($livre as $book){
            $emprunt = $book->getDateEmprunt();
            $retour = $book->getDateRetour();
            if ($emprunt != null && $retour != null){
                $diff = $emprunt->diff($retour);
                if ($diff->days > 21){
                    $this->addFlash('error', 'Vous avez des livres non rendus');
                }
            }
        }


        return $this->render('inscrit/index.html.twig');
    }

}
