<?php

namespace App\Forms;

use App\Model\Orm\Repository\UsersRepository;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;

class SignInFormFactory extends \Nette\Forms\Form
{

public function __construct()
    {
        parent::__construct();

    }

public function create(): Form
    {
        $form = new Form;
        $form->addEmail('email', 'Email:')
             ->setHtmlAttribute('class', 'form-control')
            ->addRule(Form::Email, 'Prosím zadejte platný email.')
             ->setRequired('Zadejte prosím email.');

        $form->addPassword('password', 'Heslo:')
             ->setHtmlAttribute('class', 'form-control')
             ->setRequired('Zadejte prosím heslo.');

        $form->addCheckbox('remember', ' Zapamatovat si mě na tomto počítači')
             ->setHtmlAttribute('class', 'form-check-input');

        $form->addSubmit('send', 'Přihlásit se')
             ->setHtmlAttribute('class', 'btn btn-gradient');

        return $form;
    }

}