<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findLatest()
    {
        return $this->getLatestQueryBuilder();
    }

    public function getLatestWithLimit($limit = 15)
    {
        return $this->getLatestQueryBuilder()
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function getLatestQueryBuilder()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC');
    }
}
