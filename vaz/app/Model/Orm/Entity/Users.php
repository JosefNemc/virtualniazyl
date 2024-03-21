<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use App\Model\Orm\Enums\RoleTypeEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use libphonenumber\PhoneNumber;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\MappedSuperclass]

class Users
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[ORM\Column(type: 'string', length: 255)]
    public string $userName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    public string $email;

    #[ORM\Column(type:RoleTypeEnum::ROLE_TYPE_ENUM, length: 255)]
    private string $role;

    #[ORM\Column(type: 'string', length: 512)]
    private string $password;

    #[ORM\Column(type: 'string', length: 2048, nullable: true)]
    private string $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mailVerifyToken;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: "Users")]
    #[ORM\JoinColumn(name: "created_by", referencedColumnName: "id")]
    public ?Users $createdBy;


    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(targetEntity: "Users")]
    #[ORM\JoinColumn(name: "updated_by", referencedColumnName: "id")]
    public ?Users $updatedBy;


    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $verified;

    #[ORM\OneToMany(targetEntity: "Photo", mappedBy: "user")]
    #[ORM\Column(type: 'integer', nullable: true)]
    public Photo $photos;

    #[ORM\OneToMany(targetEntity: "Message", mappedBy: "sender")]
    public Collection $sentMessages;

    #[ORM\OneToMany(targetEntity: "Message", mappedBy: "receiver")]
    private Collection $receivedMessages;

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
    public News $news;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $adoptionVerification;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $legalTerms;

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

    public function getNews(): News
    {
        return $this->news;
    }


    public function getPhotos(): Photo
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

    public function setCreatedBy(?Users $createdBy): void
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

    public function getUpdatedBy(): Users
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?Users $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): Users
    {
        $this->role = $role;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Users
    {
        $this->password = $password;
        return $this;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setReceivedMessages(Collection $receivedMessages): void
    {
        $this->receivedMessages = $receivedMessages;
    }

    public function getFirstName(): ?string
    {
        return $this?->firstName;
    }

    public function setFirstName(string $firstName): Users
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $lastName = $this->lastName;
    }

    public function setLastName(string $lastName): Users
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;


    }

    public function isMailverified(): bool
    {
        return $this->mailverified;
    }

    public function setMailverified(bool $mailverified): Users
    {
        $this->mailverified = $mailverified;
        return $this;
    }

    public function findOneBy(array $array)
    {
    }

    public function isAdoptionVerification(): bool
    {
        return $this->adoptionVerification;
    }

    public function setAdoptionVerification(bool $adoptionVerification): Users
    {
        $this->adoptionVerification = $adoptionVerification;
        return $this;
    }

    public function isLegalTerms(): bool
    {
        return $this->legalTerms;
    }

    public function setLegalTerms(bool $legalTerms): Users
    {
        $this->legalTerms = $legalTerms;
        return $this;
    }

    public function getPhone(): PhoneNumber
    {
        $phone = new PhoneNumber($this->phone);
        $phone->setRawInput($this->phone);

        return $phone;
    }
    public function setPhone($phone) : void
    {
        $this->phone = $phone;
    }

    public function getMailVerifyToken(): string
    {
        return $this->mailVerifyToken;
    }

    public function setMailVerifyToken(string $mailVerifyToken): void
    {
        $this->mailVerifyToken = $mailVerifyToken;
    }


}