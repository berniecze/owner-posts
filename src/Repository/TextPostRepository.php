<?php

namespace App\Repository;

use App\Entity\TextPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextPost[]    findAll()
 * @method TextPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextPost::class);
    }
}
