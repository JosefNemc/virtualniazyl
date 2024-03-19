<?php
declare(strict_types=1);

namespace App\Forms;


use Nette\Forms\Form;

class helpFormFactory extends Form
{
    public function create(): Form
    {
        $form = new Form;
        $form->addText('name', 'Jméno:')
            ->setRequired('Prosím zadejte své jméno.');

        $form->addText('email', 'Email:')
            ->setRequired('Prosím zadejte svůj email.')
            ->addRule(Form::Email, 'Prosím zadejte platný email.');

        $form->addTextArea('message', 'Zpráva:')
            ->setRequired('Prosím zadejte zprávu.');

        $form->addSubmit('send', 'Odeslat');

        $form->onSuccess[] = [$this, 'formHelpSucceeded'];
        return $form;
    }

}