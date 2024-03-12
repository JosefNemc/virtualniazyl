<?php

namespace App\Forms;

use App\Entity\Users;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Nette\Application\UI\Form;

class SignInFormFactory
{
     public function __construct()
    {

    }

    public function create(): Form
    {
        $form = new Form;
        $form->addEmail('email', 'Email:')
            ->setHtmlAttribute('class','form-control')
             ->setRequired('Zadejte prosím email.');

        $form->addPassword('password', 'Heslo:')
             ->setHtmlAttribute('class','form-control')
             ->setRequired('Zadejte prosím heslo.');

        $form->addCheckbox('remember', 'Zapamatovat si mě na tomto počítači')
            ->setHtmlAttribute('class','form-check-input');

        $form->addSubmit('send', 'Přihlásit se')
            ->setHtmlAttribute('class','btn btn-gradient');

        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, \stdClass $values): void
    {

    }


}