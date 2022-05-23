<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Doctor>
 *
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function add(Doctor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Doctor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Doctor[] Returns an array of Doctor objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findOneByID(int $value): ?Doctor
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByName(string $name): ?Doctor
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.name = :val')
            ->setParameter('val', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
