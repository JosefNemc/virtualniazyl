<?php
// src/Entity/Animal.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'animals')]
class Animal
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: "Owner", inversedBy: "animals")]
    #[ORM\JoinColumn(name: "owner_id", referencedColumnName: "id")]
    private Owner $owner;

    #[ORM\ManyToOne(targetEntity: "Species", inversedBy: "animals")]
    private Species $species;

    #[ORM\Column(type: 'float', length: 5)]
    private int $age;

    #[ORM\Column(type: 'string', length: 255)]
    private string $breed;

    #[ORM\OneToMany(targetEntity: "Photo", mappedBy: "animal")]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "id")]
    private Photo $photos;

    #[ORM\OneToMany(targetEntity: "Adoption", mappedBy: "animal")]
    #[ORM\JoinColumn(name: "animal_id", referencedColumnName: "id")]
    private Adoption $adoptions;
}
