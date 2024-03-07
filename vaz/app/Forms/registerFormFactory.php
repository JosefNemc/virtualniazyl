<?php

namespace App\Forms;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;
use Doctrine\ORM\EntityManagerInterface;


class RegisterFormFactory extends Form
{
    public function __construct(private readonly User $user, protected readonly EntityManagerInterface $entityManagerInterface)
    {
    }

    public function create(): Form
    {
        $form = new Form;
        $form->addText('username', 'Uživatelské jméno:')
            ->setRequired('Zadejte prosím uživatelské jméno.');

        $form->addPassword('password', 'Heslo:')
            ->setRequired('Zadejte prosím heslo.');

        $form->addPassword('password2', 'Heslo znovu:')
            ->setRequired('Zadejte prosím heslo znovu.');

        $form->addText('email', 'Email:')
            ->setRequired('Zadejte prosím email.');

        $form->addText('phone', 'Telefon:')
            ->setRequired('Zadejte prosím platný telefon.');

        $form->addSubmit('send', 'Registrovat se');

        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, \stdClass $values): void
    {
        //$this->entityManagerInterface-> ->fetch('username', $values->username);
        try {
            $this->user->login($values->username, $values->password);

        } catch (AuthenticationException $e) {
            $form->addError('Neplatné uživatelské jméno nebo heslo.');

        }
    }
}