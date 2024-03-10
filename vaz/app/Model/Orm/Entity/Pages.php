<?php
declare(strict_types=1);

namespace App\Model\Orm\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pages')]

class Pages
{
    private $id;
    private $title;
    private $content;
    private $createdAt;
    private $updatedAt;
    private $visibleFrom;
    private $createdBy;
    private $deleted;

}