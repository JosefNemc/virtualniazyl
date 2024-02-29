<?php
// src/Enum/ActionsType.php

declare(strict_types=1);

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Types\Types;

class AdoptionsType extends Types
{
    const VIRTUAL_ADOPTION_TYPE = 'Virtuální adopce';
    const FULL_ADOPTION_TYPE = 'Plná adopce';
}