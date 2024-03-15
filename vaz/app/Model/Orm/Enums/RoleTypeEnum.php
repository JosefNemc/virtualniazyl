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
    public const ROLE_ADMIN = 'admin',
                 ROLE_USER = 'user',
                 ROLE_GUEST = 'guest',
                 ROLE_SUPERADMIN = 'superadmin',
                 ROLE_AZYL = 'azyl',
                 ROLE_AZYLADMIN = 'azyladmin',
                 ROLE_ADOPTER = 'adopter',
                 ROLE_ADOPTERADMIN = 'adopteradmin';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(255)';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, RoleTypeEnum::getRoles(), true)) {
            throw new InvalidArgumentException("Invalid role");
        }
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function getName()
    {
        return self::ROLE_TYPE_ENUM;
    }

}