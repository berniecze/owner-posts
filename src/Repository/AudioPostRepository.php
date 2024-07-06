<?php

namespace App\Repository;

use App\Entity\AudioPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AudioPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method AudioPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method AudioPost[]    findAll()
 * @method AudioPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AudioPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AudioPost::class);
    }
}
