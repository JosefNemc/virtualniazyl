<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'adoptions')]


class Adoption
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[manyToOne(targetEntity: "Owner", inversedBy: "adoptions")]
    #[ORM\JoinColumn(name: "owner_id", referencedColumnName: "id")]
    private Owner $owner;

    #[manyToOne(targetEntity: "Azyl", inversedBy: "adoptions")]
    #[ORM\JoinColumn(name: "azyl_id", referencedColumnName: "id")]
    private Azyl $azyl;

    #[manyToOne(targetEntity: "Animal", inversedBy: "adoptions")]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "id")]
    private Animal $animal;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'boolean')]
    private bool $deleted;

    #[ORM\Column(type: 'boolean')]
    private bool $confirmed;

    #[ORM\Column(type: 'boolean')]
    private $canceled;
    #[ORM\OneToMany(targetEntity: "AdoptionAction", mappedBy: "adoption")]
    #[ORM\JoinColumn(name: "adoption_id", referencedColumnName: "id")]
    private $adoptionActions;
}