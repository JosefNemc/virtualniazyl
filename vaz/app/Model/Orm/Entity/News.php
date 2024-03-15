<?php

declare(strict_types=1);

namespace App\Model\Orm\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: 'datetime')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime')]
    private DateTimeImmutableType $visibleFrom;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "news")]
    private Users $author;

    #[ORM\Column(type: 'boolean')]
    private $deleted;

    #[ORM\Column(type: 'boolean')]
    private $global;
    #[ORM\Column(type: 'boolean')]
    private $important;
}