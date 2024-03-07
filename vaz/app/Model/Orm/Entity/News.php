<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table(name: 'news')]

class News

{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text', length: 10024)]
    private string $content;

    #[ORM\Column(type: 'datetimeimmutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetimeimmutable')]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetimeimmutable')]
    private \DateTimeImmutable $visibleFrom;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "news")]
    private int $author;

    #[ORM\Column(type: 'boolean')]
    private $deleted;

    #[ORM\Column(type: 'boolean')]
    private $global;
    #[ORM\Column(type: 'boolean')]
    private $important;
}