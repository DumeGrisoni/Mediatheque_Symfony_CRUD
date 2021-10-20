<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('titre'),
            TextField::new('auteur'),
            TextField::new('description')->hideOnIndex(),
            DateTimeField::new('date_parution'),
            ChoiceField::new('genre')->setChoices(Livre::GENRE),
            BooleanField::new('disponible')->onlyOnForms(),
            BooleanField::new('confirme'),
            ImageField::new('file')->setUploadDir('public/images/livres')->setBasePath('images/livres')->onlyOnIndex(),
            DateTimeField::new('dateEmprunt'),
            DateTimeField::new('dateRetour'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),

        ];
    }

}
