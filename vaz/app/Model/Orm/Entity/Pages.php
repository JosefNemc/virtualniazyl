<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use App\Model\Orm\Entity\Users;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\DateTimeImmutableType;

#[ORM\Entity]
#[ORM\Table(name: 'pages')]

class Pages
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text', length: 10024)]
    private string $content;

    #[ORM\Column(type: 'date_time')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'date_time')]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'date_time')]
    private \DateTimeImmutableType $visibleFrom;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "pages")]
    private Users $author;

    #[ORM\Column(type: 'boolean')]
    private $deleted;

    #[ORM\Column(type: 'boolean')]
    private $global;
    #[ORM\Column(type: 'boolean')]
    private $important;
}