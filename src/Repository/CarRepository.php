<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

   /**
    * @return Car[]
    */
   public function findAll(): array
   {
       return $this->createQueryBuilder('c')
           ->getQuery()
           ->getArrayResult();
   }

   public function findById($id, $returnArray = true): null | array | Car
   {
       $query = $this->createQueryBuilder('c')
           ->andWhere('c.id = :id')
           ->setParameter('id', $id)
           ->getQuery();
        $cars = $returnArray
            ? $query->getArrayResult()
            : $query->execute();

        return reset($cars) ?: null;
   }

   public function delete(Car $car): void
   {
       $this->_em->remove($car);
       $this->_em->flush();
   }

   public function save(Car $car): array
   {
       $this->_em->persist($car);
       $this->_em->flush();

       return $car->toArray();
   }
}
