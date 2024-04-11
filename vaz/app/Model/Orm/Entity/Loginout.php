<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'loginout')]

//tahle tabulka sleduje kdo se kdy naposled přihlásil
class Loginout
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    private Users $User;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $lastlogin;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $lastlogout;

    #[ORM\Column(type: 'string')]
    private string $ip;

    public function getUser(): Users
    {
        return $this->User;
    }

    public function setUser(Users $User): void
    {
        $this->User = $User;
    }

    public function getLastlogin() : DateTimeImmutable
    {
        return $this->lastlogin;
    }


    public function setLastlogin($lastlogin) : void
    {
        $this->lastlogin = $lastlogin;

    }


    public function getLastlogout() : DateTimeImmutable
    {
        return $this->lastlogout;
    }

        public function setLastlogout($lastlogout) : void
    {
        $this->lastlogout = $lastlogout;

    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): loginout
    {
        $this->ip = $ip;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}