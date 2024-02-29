<?php
// src/Entity/Photo.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="photos")
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Animal", inversedBy="photos")
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="photos")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="photos")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Azyl", inversedBy="photos")
     */
    private $azyl;

    // Getters and setters...
}
