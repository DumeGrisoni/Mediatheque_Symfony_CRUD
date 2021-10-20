<?php

namespace App\EventSubscriber;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class EasyAdminEventSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $passwordHasher;

    public function __construct( UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->passwordHasher = $passwordHasher;

    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEmployeSlugAndPassword'],
        ];
    }
    public function setEmployeSlugAndPassword(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Employe)) {
            return;
        }

        $this->setPassword($entity);

    }

    private function setPassword(Employe $entity)
    {
        $pass = $entity->getPassword();

        $entity->setPassword(
            $this->passwordHasher->hashPassword($entity, $pass)
        );
        $this->manager->persist($entity);
        $this->manager->flush();
    }


}