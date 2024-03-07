<?php

namespace App\Entity;

use App\Model\Orm\Enums\SexTypeEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'species')]
class Species
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $speciesName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $speciesDescription;

    #[ORM\Column(type: SexTypeEnum::SEX_TYPE_ENUM, length: 255)]
    private SexTypeEnum $sex;

    #[ORM\OneToMany(targetEntity: "Animal", mappedBy: "species")]
    private Animal $animals;
}