<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="azyls")
 */

class Adoption
{
    //Animal adoptions with Animal will be adpted from azyl to owner
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="adoptions")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Azyl", inversedBy="adoptions")
     */
    private $azyl;

    //adoption to many animals or one animal

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="adoptions")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animal;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canceled;

    /**
     * @ORM\OneToMany(targetEntity="AdoptionAction", mappedBy="adoption")
     */
    private $adoptionActions;


}

