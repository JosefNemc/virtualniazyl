<?php
declare(strict_types=1);

namespace App\Model\Orm\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Model\Orm\Entity\Adoption;

class adoptionsRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $class = Adoption::class)
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }


    public function fetchAll(): array
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }

    public function saveAdoption(Adoption $adoptions): void
    {
        $this->getEntityManager()->persist($adoptions);
        $this->getEntityManager()->flush();
    }

    public function findByName(string $name): ?Adoption
    {
        return $this->findOneBy(['adoptionsName' => $name]);
    }

    public function findByAzyl(int $id): ?Adoption
    {
        return $this->findOneBy(['azylId' => $id]);
    }

    public function findByAnimal(int $id): ?Adoption
    {
        return $this->findOneBy(['animalId' => $id]);
    }

    public function deleteAdoptions(Adoption $adoptions): void
    {
        $this->getEntityManager()->remove($adoptions);
        $this->getEntityManager()->flush();
    }

    public function persist(Adoption $adoptions): void
    {
        $this->getEntityManager()->persist($adoptions);
    }

    public function getAdoptions($id): ?Adoption
    {
        return $this->findOneBy(['id' => $id]);
    }
}