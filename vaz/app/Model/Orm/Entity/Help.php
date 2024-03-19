<?php

declare(strict_types=1);

namespace App\Model\Orm\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "help")]

class Help
{
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    #[ORM\Id]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $title;

    #[ORM\Column(type: "string", length: 2048)]
    private string $helpContent;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: "author_id", referencedColumnName: "id")]
    private Users $author;

    public function __construct(string $title, string $helpContent, DateTimeImmutable $createdAt, Users $author)
    {
        $this->title = $title;
        $this->helpContent = $helpContent;
        $this->createdAt = $createdAt;
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Help
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Help
    {
        $this->title = $title;
        return $this;
    }

    public function getHelpContent(): string
    {
        return $this->helpContent;
    }

    public function setHelpContent(string $helpContent): Help
    {
        $this->helpContent = $helpContent;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Help
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getAuthor(): Users
    {
        return $this->author;
    }

    public function setAuthor(Users $author): Help
    {
        $this->author = $author;
        return $this;
    }
}