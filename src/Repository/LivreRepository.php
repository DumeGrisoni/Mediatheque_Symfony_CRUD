<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    //Systeme de recherche dans une barre de recherche par Match de mot dans la BDD
    public function search($motCle = null, $genre = null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = $this->createQueryBuilder('l');
        if ($motCle != null) {
            $query->where('MATCH_AGAINST(l.titre, l.auteur) AGAINST(:mots boolean)>0')
                ->setParameter('mots', $motCle);//SetParameter pour proteger contre les injection SQL
        }

        return $query->getQuery()->getResult();
    }
    //Systeme de pagination
    public function getPaginationLivre($page, $limit)
    {
        $query = $this->createQueryBuilder('l')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit)
            ;
        return $query->getQuery()->getResult();
    }
    //Pagination avoir le nombre total de livres
    public function getTotalLivre()
    {
        $query = $this->createQueryBuilder('l')
            ->select('COUNT(l)')
            ;
        return $query->getQuery()->getSingleScalarResult();
    }
    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
