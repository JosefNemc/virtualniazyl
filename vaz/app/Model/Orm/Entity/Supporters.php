<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "supporters")]

class Supporters
{

    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    #[ORM\Id]

    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "integer")]
    private int $howMany;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    public function __construct(string $name, int $howMany, DateTimeImmutable $createdAt)
    {
        $this->name = $name;
        $this->howMany = $howMany;
        $this->createdAt = $createdAt;
    }


    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id) : Supporters
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Supporters
    {
        $this->name = $name;
        return $this;
    }

    public function getHowMany(): int
    {
        return $this->howMany;
    }

    public function setHowMany(int $howMany): Supporters
    {
        $this->howMany = $howMany;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Supporters
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}
