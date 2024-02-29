<?php
// src/Enum/ActionType.php
declare(strict_types=1);
namespace App\Model\Orm\Enums;

use Doctrine\DBAL\Types\Types;

class ActionType extends Types
{
    const START_ADOPTION = 'Start adopce';
    const END_ADOPTION = 'Konec adopce';
    const BREAK_ADOPTION = 'Přerušení adopce';
    const CONTACT_ADOPTION = 'Kontakt';
    const PHONE_CALL_ADOPTION = 'Telefonát';
    const PERSONAL_VISIT_ADOPTION = 'Osobní kontakt';
    const VERIFICATION_ADOPTION = 'Ověření';
}