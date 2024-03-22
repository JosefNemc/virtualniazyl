<?php
declare(strict_types=1);

namespace App\Forms;


use Nette\Application\UI\Form;

class roleFormFactory extends Form
{
    public function create(): Form
    {
       $form = new Form;
       $form->addContainer('roleconteiner');
       $form->addRadioList('role','', ['azyl' => ' Chci být azyl', 'owner' => ' Chci být uživatel'])
            ->setRequired('Vyberte svou roli')
            ->setHtmlAttribute('class', 'form-check-input')
            ->setHtmlAttribute('type', 'radio');
        $form->addSubmit('send', 'Odeslat')
            ->setHtmlAttribute('class', 'btn btn-gradient');
        return $form;
    }
}