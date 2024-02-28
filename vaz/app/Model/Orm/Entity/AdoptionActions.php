<?php
// src/Entity/AdoptionAction.php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="adoption_actions")
 */
class AdoptionAction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Adoption")
     * @ORM\JoinColumn(name="adoption_id", referencedColumnName="id", nullable=true)
     */
    private $adoption;



    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $created_by;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updated_by;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action_type;

    /**
     * @ORM\ManyToOne(targetEntity="Owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=true)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Azyl")
     * @ORM\JoinColumn(name="azyl_id", referencedColumnName="id", nullable=true)
     */
    private $azyl;

    /**
     * @ORM\ManyToOne(targetEntity="Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id", nullable=true)
     */
    private $animal;

}
