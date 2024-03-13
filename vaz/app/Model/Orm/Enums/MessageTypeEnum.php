<?php
// src/Enum/MessageType.php

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MessageTypeEnum extends Type
{
    public const MESSAGE_TYPE_ENUM = 'messageTypeEnum';

    public const FROMSYSTEM_TYPE = 'Zpráva od virtuálního azylu',
         FROMADMIN_TYPE = 'Zpráva od administrátora',
        FROMUSER_TYPE = 'Zpráva od uživatele',
        TOUSER_TYPE = 'Zpráva pro uživatele',
     TOADMIN_TYPE = 'Zpráva pro administrátora',
     TOSYSTEM_TYPE = 'Zpráva pro virtuální azyl';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return "ENUM('" . implode("', '", self::getTypes()) . "')";
    }


    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform) : string
    {
        return $value;
    }

    public function getName() : string
    {
        return self::MESSAGE_TYPE_ENUM;
    }

    public static function getTypes(): array
    {
        return [
            self::FROMSYSTEM_TYPE,
            self::FROMADMIN_TYPE,
            self::FROMUSER_TYPE,
            self::TOUSER_TYPE,
            self::TOADMIN_TYPE,
            self::TOSYSTEM_TYPE
        ];
    }

    public static function getTypesForUser(): array
    {
        return [
            self::FROMSYSTEM_TYPE,
            self::FROMADMIN_TYPE,
            self::FROMUSER_TYPE,
            self::TOUSER_TYPE
        ];
    }

    public static function getTypesForAdmin(): array
    {
        return [
            self::FROMSYSTEM_TYPE,
            self::FROMADMIN_TYPE,
            self::TOADMIN_TYPE,
            self::TOSYSTEM_TYPE
        ];
    }
}