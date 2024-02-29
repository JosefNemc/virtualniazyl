<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="owners")
 */

class Owner extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ownerName;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="integer", length=5)
     */
    private $houseNumber;

    /**
     * @ORM\OneToMany(targetEntity="Adoption", mappedBy="owner")
     */
    private $adoptions;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="owner")
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;
}