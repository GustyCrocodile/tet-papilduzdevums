<?php

namespace App\Repository;

use App\Entity\IpAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IpAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpAddress[]    findAll()
 * @method IpAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpAddress::class);
    }

    // /**
    //  * @return IpAddress[] Returns an array of IpAddress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByIp($value): ?IpAddress
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.ip = :ip')
            ->setParameter('ip', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
