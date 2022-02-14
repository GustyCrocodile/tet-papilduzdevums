<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    // /**
    //  * @return Location[] Returns an array of Location objects
    //  */
    
    // public function findByIp($ip)
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.ip = :ip')
    //         ->setParameter('ip', $ip)
    //         ->orderBy('a.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    

    public function findOneByIp($value): ?Location
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.id = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
