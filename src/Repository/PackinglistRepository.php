<?php

namespace App\Repository;

use App\Entity\Packinglist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Packinglist>
 *
 * @method Packinglist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Packinglist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Packinglist[]    findAll()
 * @method Packinglist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackinglistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Packinglist::class);
    }

    public function save(Packinglist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Packinglist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findByPreferences(string $name): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.fk_preferences', 'p')
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Packinglist[] Returns an array of Packinglist objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Packinglist
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
