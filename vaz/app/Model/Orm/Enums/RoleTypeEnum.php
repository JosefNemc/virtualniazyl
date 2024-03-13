<?php
declare(strict_types=1);
namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;
use Tracy\Debugger;

class RoleTypeEnum extends Type
{
    public const ROLE_TYPE_ENUM = 'roleTypeEnum';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_GUEST = 'guest';
    public const ROLE_SUPERADMIN = 'superadmin';
    public const ROLE_AZYL = 'azyl';
    public const ROLE_AZYLADMIN = 'azyladmin';
    public const ROLE_ADOPTER = 'adopter';
    public const ROLE_ADOPTERADMIN = 'adopteradmin';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'VARCHAR(255)';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->getRoles())) {
            throw new InvalidArgumentException("Invalid role");
        }
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?string
    {
        return $value;
    }

    public function getName(): string
    {
        return self::ROLE_TYPE_ENUM;
    }

    private function getRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_GUEST,
            self::ROLE_SUPERADMIN,
            self::ROLE_AZYL,
            self::ROLE_AZYLADMIN,
            self::ROLE_ADOPTER,
            self::ROLE_ADOPTERADMIN,
        ];
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
                return 'badge-guest';
        }
    }
}