<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'azyls')]

class Azyl extends Users
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $azylName;

    #[ORM\Column(type: 'string', length: 1024)]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private string $street;

    #[ORM\Column(type: 'string', length: 255)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private string $houseNumber;

    #[ORM\OneToMany(targetEntity: "Adoption", mappedBy: "azyl")]
    #[ORM\JoinColumn(name: "azyl_id", referencedColumnName: "id")]
    private Adoption $adoptions;

    #[ORM\OneToMany(targetEntity: "Photo", mappedBy: "azyl")]
    #[ORM\JoinColumn(name: "azyl_id", referencedColumnName: "id")]
    private Photo $photos;

    #[ORM\Column(type: 'string', length: 255)]
    private string $bankAccount;

    #[ORM\Column(type: 'string', length: 255)]
    private string $bankCode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $bankSpecificCode;
    #[ORM\Column(type: 'string', length: 255)]
    private string $phoneNumber;
}

