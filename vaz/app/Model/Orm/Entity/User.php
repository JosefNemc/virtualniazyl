<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
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
    private $userName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": 0})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": 0})
     */
    private $updatedBy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $verified;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="user")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="sender")
     */
    private $sentMessages;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="receiver")
     */
    private $receivedMessages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(type="boolean")
     */
    private $baned;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mailverified;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="user")
     */
    private $news;

    public function __construct()
    {
        $this->sentMessages = new ArrayCollection();
        $this->receivedMessages = new ArrayCollection();
    }

    // Getters and setters...

    /**
     * @return Collection|Message[]
     */
    public function getSentMessages(): Collection
    {
        return $this->sentMessages;
    }

    /**
     * @return Collection|Message[]
     */
    public function getReceivedMessages(): Collection
    {
        return $this->receivedMessages;
    }

}