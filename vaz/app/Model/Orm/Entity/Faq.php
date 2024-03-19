<?php

declare(strict_types=1);

namespace App\Model\Orm\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "faq")]

class Faq
{
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    #[ORM\Id]
    private $id;

    #[ORM\Column(type: "string", length: 1024)]
    private string $question;

    #[ORM\Column(type: "string", length: 2048)]
    private string $answer;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    public function __construct(string $question, string $answer, DateTimeImmutable $createdAt)
    {
        $this->question = $question;
        $this->answer = $answer;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id) : Faq
    {
        $this->id = $id;
        return $this;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): Faq
    {
        $this->question = $question;
        return $this;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): Faq
    {
        $this->answer = $answer;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Faq
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}