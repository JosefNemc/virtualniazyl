<?php
// src/Entity/Photo.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'photos')]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'DateTimeImmutable')]
    private \DateTimeImmutable $date;

    #[ORM\ManyToOne(targetEntity: "Animal", inversedBy: "photos")]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "id")]
    private Animal $animal;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "photos")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private Users $user;

    #[ORM\ManyToOne(targetEntity: "Owner", inversedBy: "photos")]
    #[ORM\JoinColumn(name: "owner_id", referencedColumnName: "id")]
    private Owner $owner;

    #[ORM\ManyToOne(targetEntity: "Azyl", inversedBy: "photos")]
    #[ORM\JoinColumn(name: "azyl_id", referencedColumnName: "id")]
    private Azyl $azyl;
}
