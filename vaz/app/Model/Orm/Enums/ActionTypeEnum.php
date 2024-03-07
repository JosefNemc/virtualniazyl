<?php
// src/Enum/ActionType.php
declare(strict_types=1);
namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Types;

class ActionTypeEnum extends Types
{
    const START_ADOPTION = 'Start adopce';
    const END_ADOPTION = 'Konec adopce';
    const BREAK_ADOPTION = 'Přerušení adopce';
    const CONTACT_ADOPTION = 'Kontakt';
    const PHONE_CALL_ADOPTION = 'Telefonát';
    const PERSONAL_VISIT_ADOPTION = 'Osobní kontakt';
    const VERIFICATION_ADOPTION = 'Ověření';


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

}