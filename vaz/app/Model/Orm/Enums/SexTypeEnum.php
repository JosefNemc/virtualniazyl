<?php

namespace App\Model\Orm\Enums;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Types;

class SexTypeEnum extends Types
{
    const SEX_TYPE_ENUM = 'sexTypeEnum';
    const MALE_EMUM = 'male',
        FEMALE_ENUM = 'female',
        UNKNOWN_ENUM = 'unknown',
        HERMAPHRODITE_ENUM = 'hermaphrodite';

    public static function getSexTypes(): array
    {
        return [
            self::FEMALE_ENUM,
            self::MALE_EMUM,
            self::UNKNOWN_ENUM,
            self::HERMAPHRODITE_ENUM
        ];
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform):string
    {
        return "ROLE('" . implode("', '", self::getSexTypes()) . "')";
    }

    public function getPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, self::getSexTypes())) {
            throw new \InvalidArgumentException
            (
                "Invalid value for
                sexTypeEnum: " . $value
            );
        }
    return $value;
    }
}