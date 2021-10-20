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
        $admin = new Administrateur();
        $admin->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPrenom('John')
            ->setNom('Smith')
            ->setPassword($this->passwordHasher->hashPassword($admin, 'Administrateur02!'));
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
