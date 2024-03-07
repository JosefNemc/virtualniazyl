<?php
declare(strict_types=1);

namespace App\Entity;

use App\Model\Orm\Enums\RoleTypeEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;

#[Entity]
#[Table(name: 'users')]

class Users
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $userName;

    #[Column(type: 'string', length: 255, nullable: true)]
    private string $firstName;

    #[Column(type: 'string', length: 255, nullable: true)]
    private string $lastName;

    #[Column(type: 'string', length: 255)]
    private string $email;

    #[Column(type: RoleTypeEnum::ROLE_TYPE_ENUM, length: 255)]
    private RoleTypeEnum $role;

    #[Column(type: 'string', length: 512)]
    private string $password;

    #[Column(type: 'DateTimeImmutable')]
    private DateTimeImmutable $createdAt;

     #[OneToOne(targetEntity: "Users", inversedBy: "user")]
     #[JoinColumn(name: "createdBy", referencedColumnName: "id")]
     #[Column(type: 'integer', nullable: 'true')]
     private int $createdBy;

    #[Column(type: 'DateTimeImmutable', nullable: true, options: ['default' => 0])]
    private DateTimeImmutable $updatedAt;

    #[OneToOne(targetEntity: "Users", inversedBy: "user")]
    #[JoinColumn(name: "updatedBy", referencedColumnName: "id")]
    #[Column(type: 'integer', nullable: 'true')]
    private $updatedBy;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $verified;

    #[OneToMany(targetEntity: "Photo", mappedBy: "user")]
    #[Column(type: 'integer', nullable: 'true')]
    private int $photos;

    #[OneToMany(targetEntity: "Message", mappedBy: "sender")]
    protected Entity $sentMessages;

    #[OneToMany(targetEntity: "Message", mappedBy: "receiver")]
    private Entity $receivedMessages;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $deleted;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $baned;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $mailverified;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $phoneVerified;

    #[OneToMany(targetEntity: "News", mappedBy: "user")]
    #[Column(type: 'integer', nullable: 'true')]
    private $news;

    public function __construct()
    {
    }

    public function getSentMessages(): Collection
    {
        return $this->sentMessages;
    }


    public function getReceivedMessages(): Collection
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
        return $this->users;
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


    public function getPhotos(): Collection
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
}