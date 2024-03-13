<?php

namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class ActionTypeEnum extends Type
{
    public const ACTION_TYPE_ENUM = 'actionTypeEnum';
    public const START_ADOPTION = 'Start adopce';
    public const END_ADOPTION = 'Konec adopce';
    public const BREAK_ADOPTION = 'Přerušení adopce';
    public const CONTACT_ADOPTION = 'Kontakt';
    public const PHONE_CALL_ADOPTION = 'Telefonát';
    public const PERSONAL_VISIT_ADOPTION = 'Osobní kontakt';
    public const VERIFICATION_ADOPTION = 'Ověření';

    public function getName(): string
    {
        return self::ACTION_TYPE_ENUM;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $actions = [
            self::START_ADOPTION,
            self::END_ADOPTION,
            self::BREAK_ADOPTION,
            self::CONTACT_ADOPTION,
            self::PHONE_CALL_ADOPTION,
            self::PERSONAL_VISIT_ADOPTION,
            self::VERIFICATION_ADOPTION
        ];
        $quotedActions = array_map(fn($action) => $platform->quoteStringLiteral($action), $actions);
        return 'ENUM(' . implode(', ', $quotedActions) . ')';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, self::getActionTypes())) {
            throw new \InvalidArgumentException("Invalid Action Type");
        }
        return $value;
    }

    public static function getActionTypes(): array
    {
        return [
            self::START_ADOPTION,
            self::END_ADOPTION,
            self::BREAK_ADOPTION,
            self::CONTACT_ADOPTION,
            self::PHONE_CALL_ADOPTION,
            self::PERSONAL_VISIT_ADOPTION,
            self::VERIFICATION_ADOPTION
        ];
    }
}