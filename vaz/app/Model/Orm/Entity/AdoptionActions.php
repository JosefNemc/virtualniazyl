<?php
// src/Entity/AdoptionAction.php

declare(strict_types=1);

namespace App\Model\Orm\Entity;

use App\Model\Orm\Enums\ActionTypeEnum;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'adoption_actions')]

class AdoptionAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: "Adoption")]
    #[ORM\JoinColumn(name: "adoption_id", referencedColumnName: "id", nullable: true)]
    private Adoption $adoption;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(targetEntity: "Users")]
    #[ORM\JoinColumn(name: "createdBy", referencedColumnName: "id")]
    public Users $createdBy;

    #[ORM\ManyToOne(targetEntity: "Users")]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private Users $updatedBy;

    #[ORM\Column(type: 'text', nullable: true)]
    private string $description;

    #[ORM\Column(type: ActionTypeEnum::ACTION_TYPE_ENUM, length: 255)]
    private ActionTypeEnum $actionTypeEnum;

    #[ORM\ManyToOne(targetEntity: "Owner")]
    #[ORM\JoinColumn(name: "owner_id", referencedColumnName: "id", nullable: true)]
    private Owner $owner;

    #[ORM\ManyToOne(targetEntity: "Azyl")]
    #[ORM\JoinColumn(name: "azyl_id", referencedColumnName: "id", nullable: true)]
    private Azyl $azyl;
    #[ORM\ManyToOne(targetEntity: "Animal")]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "id", nullable: true)]
    private Animal $animal;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
