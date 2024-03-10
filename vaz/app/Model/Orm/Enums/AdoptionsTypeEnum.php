<?php
// src/Enum/ActionsType.php

declare(strict_types=1);

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Types;

class AdoptionsTypeEnum extends Types
{
    const VIRTUAL_ADOPTION_TYPE = 'Virtuální adopce';
    const FULL_ADOPTION_TYPE = 'Plná adopce';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDoctrineTypeMapping('string');
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }
}