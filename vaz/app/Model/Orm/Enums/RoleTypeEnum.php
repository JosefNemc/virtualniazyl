<?php
declare(strict_types=1);
namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\Entity;
use InvalidArgumentException;
use Tracy\Debugger;


#[Entity]
#[Type('roleTypeEnum')]

class RoleTypeEnum extends Type
{
    const ROLE_TYPE_ENUM = 'roleTypeEnum';
    const ROLE_ADMIN = 'admin',
                 ROLE_USER = 'user',
                 ROLE_GUEST = 'guest',
                 ROLE_SUPERADMIN = 'superadmin',
                 ROLE_AZYL = 'azyl',
                 ROLE_AZYLADMIN = 'azyladmin',
                 ROLE_ADOPTER = 'adopter',
                 ROLE_ADOPTERADMIN = 'adopteradmin';

    public static function getTypes(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_GUEST,
            self::ROLE_SUPERADMIN,
            self::ROLE_AZYL,
            self::ROLE_AZYLADMIN,
            self::ROLE_ADOPTER,
            self::ROLE_ADOPTERADMIN
        ];
    }

    public static function getTypesForUser(): array
    {
        return [
            self::ROLE_USER,
            self::ROLE_GUEST,
            self::ROLE_AZYL,
            self::ROLE_ADOPTER
        ];
    }

    private static function getRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_GUEST,
            self::ROLE_SUPERADMIN,
            self::ROLE_AZYL,
            self::ROLE_AZYLADMIN,
            self::ROLE_ADOPTER,
            self::ROLE_ADOPTERADMIN
        ];
    }

      public function getSQLDeclaration(array            $fieldDeclaration,
                                      AbstractPlatform $platform) : string
    {
        return "ROLE('" . implode("', '", self::getRoles()) . "')";

    }

    public function getBadgeClass($role)
    {
        switch ($role) {
            case self::ROLE_ADMIN:
                return 'badge-admin';
            case self::ROLE_USER:
                return 'badge-user';
            case self::ROLE_GUEST:
                return 'badge-guest';
            case self::ROLE_SUPERADMIN:
                return 'badge-superadmin';
            case self::ROLE_AZYL:
                return 'badge-azyl';
            case self::ROLE_AZYLADMIN:
                return 'badge-azyladmin';
            case self::ROLE_ADOPTER:
                return 'badge-adopter';
            case self::ROLE_ADOPTERADMIN:
                return 'badge-adopteradmin';
            default:
                Debugger::log("Unknown role: $role", Debugger::ERROR);
                return "badge badge-guest";
        }

    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, self::getRoles())) {
            throw new InvalidArgumentException("Invalid status");
        }
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

    public function getName(): string
    {
        return self::ROLE_TYPE_ENUM;
    }
}