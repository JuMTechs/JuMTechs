<?php

namespace App\Repository;

use App\Entity\eventhostinfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<eventhostinfo>
 *
 * @method eventhostinfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method eventhostinfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method eventhostinfo[]    findAll()
 * @method eventhostinfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class eventhostinfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, eventhostinfo::class);
    }

    public function save(eventhostinfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) 
        {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(eventhostinfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) 
        {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return eventhostinfo[] Returns an array of eventhostinfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?eventhostinfo
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
