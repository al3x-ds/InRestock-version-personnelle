<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findSearch(ProductSearch $search) 
    {
        $query = $this->createQueryBuilder('p');

        $name = $search->getName();

        /** Si des caractères sont renseigné, alors je filtre les resultat
        * Exemple : l'utilisteur rentre le mot "mac", le repository filtera tout les elements
        * qui on les caractères "mac" dans leur nom. 
        * Dans le cas où rien n'est renseigné, le repository renverra tout les elements
        */ 

        if ($name) {
            $query->where('p.name LIKE :name')
                  ->setParameter('name', '%'.$name.'%');
        }

        return $query->getQuery();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
