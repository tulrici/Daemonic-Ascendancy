<?php

namespace App\Repository;

use App\Entity\Ladder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Ladder>
 */
class LadderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, entityManagerInterface $entityManager)
    {
        parent::__construct($registry, Ladder::class);
    }

    public function save(Ladder $ladder): int
    {
        $this->enntityManager->persist($ladder);
        $this->entityManager->flush();
        return $id = $ladder->getId();
    }



    //    /**
    //     * @return Ladder[] Returns an array of Ladder objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ladder
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
