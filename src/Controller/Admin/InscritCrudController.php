<?php

namespace App\Controller\Admin;

use App\Entity\Inscrit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InscritCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscrit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom')->setLabel('Nom'),
            TextField::new('prenom')->setLabel('Prenom'),
            TextField::new('adresse_postale')->setLabel('Adresse Postale'),
            TextField::new('email')->setLabel('Adresse Email'),
            ChoiceField::new('roles')->setChoices(Inscrit::ROLE)->allowMultipleChoices()
        ];
    }

}
