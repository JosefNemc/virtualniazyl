<?php

namespace App\Model\Orm\Repository;

use App\Model\Orm\Entity\Animal;
use App\Model\Orm\Entity\Species;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class AnimalsRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $class = 'Animal::class')
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }

    public function findAll(): array
    {
        return $this->findBy([], ['name' => 'ASC']);
    }

    public function findBySpecies(string $species): array
    {
        return $this->findBy(['species' => $species]);
    }

    public function fetchAll(): array
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }
}