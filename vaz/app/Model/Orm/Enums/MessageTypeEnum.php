<?php
// src/Enum/MessageType.php

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MessageTypeEnum extends Type
{
    public const FROMSYSTEM_TYPE = 'Zpráva od virtuálního azylu';
    public const FROMADMIN_TYPE = 'Zpráva od administrátora';
    public const FROMUSER_TYPE = 'Zpráva od uživatele';
    public const TOUSER_TYPE = 'Zpráva pro uživatele';
    public const TOADMIN_TYPE = 'Zpráva pro administrátora';
    public const TOSYSTEM_TYPE = 'Zpráva pro virtuální azyl';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDoctrineTypeMapping('string');
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
        return 'message_type';
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