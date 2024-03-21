<?php
declare(strict_types=1);

namespace App\Forms;


use Nette\Application\UI\Form;

class roleFormFactory extends Form
{
    public function create(): Form
    {
       $form = new Form;
       $form->addContainer('role');
       $form->addRadioList('role', 'Role', ['azyl' => 'Chci být azyl', 'owner' => 'Chci být uživatel'])
            ->setRequired('Vyberte svou roli');
        $form->addSubmit('send', 'Odeslat');
        return $form;
    }
}