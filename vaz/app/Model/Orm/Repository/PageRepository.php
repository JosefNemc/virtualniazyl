<?php

declare(strict_types=1);

namespace App\Model\Orm\Repository;

use App\Model\Orm\Entity\Pages;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $entityClass = Pages::class)
    {
        parent::__construct($em, $em->getClassMetadata($entityClass));
    }

    public function fetchAll(): array
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    public function findOneBy(array $criteria, ?array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function remove(Pages $page): void
    {
        $this->getEntityManager()->remove($page);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

public function delete(Pages $page): void
    {
        $page->setDeleted(true);
        $this->getEntityManager()->flush();
    }
}