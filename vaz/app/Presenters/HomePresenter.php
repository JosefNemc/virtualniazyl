<?php

declare(strict_types=1);

namespace App\Presenters;

use AllowDynamicProperties;
use App\Forms\registerFormFactory;
use App\Forms\SignInFormFactory;
use App\Model\Orm\Repository\UsersRepository;
use App\Model\Services\MyAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Nette\Forms\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;


#[AllowDynamicProperties] final class HomePresenter extends Nette\Application\UI\Presenter
{
    protected EntityManagerInterface $entityManager;
    protected UsersRepository $usersRepository;


    public function __construct(UsersRepository                        $usersRepository,
                                EntityManagerInterface                 $entityManager,
                                protected readonly SignInFormFactory   $signInFormFactory,
                                protected readonly RegisterFormFactory $registerFormFactory,
                                private            Passwords           $passwords)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->usersRepository = $usersRepository;
        $this->passwords = $passwords;

    }
    public function renderDefault(): void
    {
        $this->getTemplate()->title = 'Domácí stránka';
        bdump($this->getTemplate()->users = $this->usersRepository->fetchAll());

    }

    public function actionSignIn(): void
    {
        $this->getTemplate()->title = 'Přihlášení';

    }

    public function actionLogedIn(): void
    {
        $this->getTemplate()->title = 'Přihlášení';
    }

    public function actionLogOut(): void
    {
        $this->getUser()->logout();
        $this->getPresenter()->flashMessage('Odhlášení proběhlo v pořádku.', 'alert-success');
        $this->redirect('Home:default');
    }


    public function createComponentSignInForm(): Form
    {

        $passwords = new Nette\Security\Passwords;
        $form = (new SignInFormFactory())->create();
        $form->onSuccess[] = [$this, 'formSignInSucceeded'];

        return $form;
    }
    public function formSignInSucceeded(\Nette\Application\UI\Form $form, \stdClass $values): void
    {
        try {
            $this->getUser()->login($values->email, $values->password);
            $this->getPresenter()->flashMessage('Přihlášení se zdařilo', 'alert-success');
            $this->getPresenter()->redirect('Home:default');
        } catch (AuthenticationException $e) {
            $this->getPresenter()->flashMessage('Uživatelské jméno nebo heslo je špatně', 'alert-warning');

        }
    }

    public function createComponentRegisterForm(): RegisterFormFactory
    {
        return new $this->registerFormFactory->create();
    }
}
