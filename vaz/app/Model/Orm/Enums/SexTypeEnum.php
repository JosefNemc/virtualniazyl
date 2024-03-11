<?php

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class SexTypeEnum extends Type
{
    const SEX_TYPE_ENUM = 'sexTypeEnum';
    const MALE_ENUM = 'male';
    const FEMALE_ENUM = 'female';
    const UNKNOWN_ENUM = 'unknown';
    const HERMAPHRODITE_ENUM = 'hermaphrodite';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform):string
    {
        return "ENUM('" . implode("', '", self::getSexTypes()) . "')";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value; // no need for conversion here, we're storing the value as is
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value; // no need for conversion here, we're storing the value as is
    }

    public function getName():string
    {
        return self::SEX_TYPE_ENUM;
    }

    public static function getSexTypes(): array
    {
        return [
            self::FEMALE_ENUM,
            self::MALE_ENUM,
            self::UNKNOWN_ENUM,
            self::HERMAPHRODITE_ENUM
        ];
    }
}
