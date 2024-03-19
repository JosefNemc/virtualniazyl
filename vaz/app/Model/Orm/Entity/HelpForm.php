<?php

namespace App\Model\Orm\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "help_form")]


class HelpForm
{
   #[ORM\GeneratedValue(strategy: "IDENTITY")]
   #[ORM\Column(type: "integer")]
   #[ORM\Id]
   private $id;
   #[ORM\Column(type: "string", length: 255)]
   private string $name;
   #[ORM\Column(type: "string", length: 255)]
   private string $email;
   #[ORM\Column(type: "text", length: 2048)]
   private string $message;
   #[ORM\Column(type: "string", length: 255)]
   private string $page;
   #[ORM\Column(type: "datetime_immutable")]
   private DateTimeImmutable $createdAt;
   #[ORM\Column(type: "string", length: 255)]
   private $postfromaddres; //ipaddress
   #[ORM\Column(type: "text", length: 1024)]
   private string $userAgent;

    public function __construct(string $name, string $email, string $message, string $page, DateTimeImmutable $createdAt, $postfromaddres, string $userAgent)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->page = $page;
        $this->createdAt = $createdAt;
        $this->postfromaddres = $postfromaddres;
        $this->userAgent = $userAgent;
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
     * @return HelpForm
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): HelpForm
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): HelpForm
    {
        $this->email = $email;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): HelpForm
    {
        $this->message = $message;
        return $this;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): HelpForm
    {
        $this->page = $page;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): HelpForm
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostfromaddres()
    {
        return $this->postfromaddres;
    }

    /**
     * @param mixed $postfromaddres
     * @return HelpForm
     */
    public function setPostfromaddres($postfromaddres)
    {
        $this->postfromaddres = $postfromaddres;
        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): HelpForm
    {
        $this->userAgent = $userAgent;
        return $this;
    }


}

