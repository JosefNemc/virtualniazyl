<?php

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class AdoptionsTypeEnum extends Type
{
    public const ADOPTION_TYPE_ENUM = 'adoptionsTypeEnum';
    public const VIRTUAL_ADOPTION_TYPE = 'Virtuální adopce',
                 FULL_ADOPTION_TYPE = 'Plná adopce';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDoctrineTypeMapping('string');
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

    public function getName(): string
    {
        return 'adoptionsTypeEnum';
    }
}
