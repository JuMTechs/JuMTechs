<?php

namespace App\Repository;

use App\Entity\EventHostInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventHostInfo>
 *
 * @method EventHostInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventHostInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventHostInfo[]    findAll()
 * @method EventHostInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventHostInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventHostInfo::class);
    }

    public function save(EventHostInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) 
        {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EventHostInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) 
        {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EventHostInfo[] Returns an array of EventHostInfo objects
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

//    public function findOneBySomeField($value): ?EventHostInfo
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
