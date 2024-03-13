<?php
declare(strict_types=1);

namespace App\Entity;

use App\Model\Orm\Enums\RoleTypeEnum;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use http\Client\Curl\User;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\MappedSuperclass]

class Users
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $userName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'roleTypeEnum', length: 255)]
    private RoleTypeEnum $role;

    #[ORM\Column(type: 'string', length: 512)]
    private string $password;

    #[ORM\Column(type: 'datetime')]
    private DateTimeImmutableType $createdAt;

     #[ORM\OneToOne(targetEntity: "Users", inversedBy: "user")]
     #[ORM\JoinColumn(name: "createdBy", referencedColumnName: "id")]
     #[ORM\Column(type: 'integer', nullable: true)]
     private Users $createdBy;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeImmutableType $updatedAt;

    #[ORM\OneToOne(targetEntity: "Users", inversedBy: "user")]
    #[ORM\JoinColumn(name: "updatedBy", referencedColumnName: "id")]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $updatedBy;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $verified;

    #[ORM\OneToMany(targetEntity: "Photo", mappedBy: "user")]
    #[ORM\Column(type: 'integer', nullable: true)]
    private int $photos;

    #[ORM\OneToMany(targetEntity: "Message", mappedBy: "sender")]
    private Entity $sentMessages;

    #[ORM\OneToMany(targetEntity: "Message", mappedBy: "receiver")]
    private Entity $receivedMessages;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $deleted;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $baned;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $mailverified;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $phoneVerified;

    #[ORM\OneToMany(targetEntity: "News", mappedBy: "user")]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $news;

    public function __construct()
    {
    }

    public function getSentMessages(): Entity
    {
        return $this->sentMessages;
    }


    public function getReceivedMessages(): Entity
    {
        return $this->receivedMessages;
    }



    public function setBaned($baned): void
    {
        $this->baned = $baned;
    }


    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }

    public function setVerified($verified): void
    {
        $this->verified = $verified;
    }

    public function getUsers(): Collection
    {
        return $this->getUsers();
    }


    public function getVerified(): bool
    {
        return $this->verified;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function isBaned(): bool
    {
        return $this->baned;
    }


    public function isMeilVerified(): bool
    {
        return $this->mailverified;
    }

    public function setMeilVerified(bool $meilVerified): void
    {
        $this->mailverified = $meilVerified;
    }

    public function isPhoneVerified(): bool
    {
        return $this->phoneVerified;
    }

    public function setPhoneVerified(bool $phoneVerified): void
    {
        $this->phoneVerified = $phoneVerified;
    }

    public function getNews(): Collection
    {
        return $this->news;
    }


    public function getPhotos(): int
    {
        return $this->photos;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setReceivedMessages(Entity $receivedMessages): void
    {
        $this->receivedMessages = $receivedMessages;
    }
}