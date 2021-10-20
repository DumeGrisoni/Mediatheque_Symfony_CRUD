<?php

namespace App\DataFixtures;

use App\Entity\Administrateur;
use App\Entity\Employe;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new Employe();
        $admin->setEmail('employe@test.com')
            ->setRoles(['ROLE_EMPLOYE'])
            ->setPrenom('John')
            ->setNom('Smith')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'employe'));
//        $date = new \DateTime(date('d-m-y'));
//        $livres = new Livre();
//        $livres->setTitre('Le roi Lion')
//            ->setDescription('Le livre du roi lion')
//            ->setAuteur('Disney')
//            ->setDateParution($date)
//            ->setGenre('Enfant')
//            ->setDisponible(true);
        $manager->persist($admin);
        $manager->flush();
    }
}
