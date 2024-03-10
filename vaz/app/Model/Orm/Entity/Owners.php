<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Users;
use mysql_xdevapi\Collection;
use Nette\Neon\Entity;

#[ORM\Entity]
#[ORM\Table(name: 'owners')]

class Owner extends Users
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $ownerName;

    #[ORM\Column(type: 'string', length: 1024)]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private string $street;

    #[ORM\Column(type: 'string', length: 255)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private string $zipCode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $houseNumber;

    #[ORM\ManyToOne(targetEntity: "Adoption", inversedBy: "owner")]
    private Adoption $adoptions;

    #[ORM\OneToMany(targetEntity: "Photo", mappedBy: "owner")]
    private Photo $photos;

    #[ORM\Column(type: 'string', length: 255)]
    private string $phoneNumber;

    public function __construct(Adoption $adoptions, Photo $photos)
    {
        $this->adoptions = new ORM\Entity();
        $this->photos = new ORM\Entity();
    }

    public function getAdoptions(): Adoption
    {
        return $this->adoptions;
    }

    public function setAdoptions(Adoption $adoptions): void
    {
        $this->adoptions = $adoptions;
    }

    public function setPhotos(Photo $photos): void
    {
        $this->photos = $photos;
    }
}

