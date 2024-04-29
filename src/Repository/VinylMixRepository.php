<?php

namespace App\Repository;

use App\Entity\VinylMix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VinylMix>
 *
 * @method VinylMix|null find($id, $lockMode = null, $lockVersion = null)
 * @method VinylMix|null findOneBy(array $criteria, array $orderBy = null)
 * @method VinylMix[]    findAll()
 * @method VinylMix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinylMixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VinylMix::class);
    }

//    /**
//     * @return VinylMix[] Returns an array of VinylMix objects
//     */
    public function findAllOrderedByVotes(string $genre = null): array
    {
        $queryBuilder = $this->createQueryBuilder('mix')
            //->andWhere('mix.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('mix.votes', 'DESC');
            //->setMaxResults(10)
            if ($genre) {
                $queryBuilder->andWhere('mix.genre = :genre')
                    ->setParameter('genre', $genre);
            }
        
        return $queryBuilder
            ->getQuery()
            ->getResult()
        ;

    }

//    public function findOneBySomeField($value): ?VinylMix
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
