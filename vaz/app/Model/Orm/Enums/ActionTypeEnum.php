<?php
// src/Enum/ActionType.php
declare(strict_types=1);
namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Types;

class ActionTypeEnum extends Types
{
    const ACTION_TYPE_ENUM = 'actionTypeEnum';
    const START_ADOPTION = 'Start adopce',
     END_ADOPTION = 'Konec adopce',
     BREAK_ADOPTION = 'Přerušení adopce',
     CONTACT_ADOPTION = 'Kontakt',
     PHONE_CALL_ADOPTION = 'Telefonát',
     PERSONAL_VISIT_ADOPTION = 'Osobní kontakt',
     VERIFICATION_ADOPTION = 'Ověření';


//generate method for getting all types of actions



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

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $actions = self::getActionTypes();
        $quotedActions = array_map(fn($action) => $platform->quoteStringLiteral($action), $actions);
        return 'ENUM(' . implode(', ', $quotedActions) . ')';
    }


    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

}