<?php

declare(strict_types=1);

namespace App\Presenters;

use AllowDynamicProperties;
use App\Forms\registerFormFactory;
use App\Forms\SignInFormFactory;
use App\Model\Orm\Entity\Users;
use App\Model\Orm\Repository\UsersRepository;
use App\Model\Services\MyAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Nette\Forms\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;
use App\Model\Services\Menu;


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

    public function startup(): void
    {
        parent::startup();
        $menu = new Menu();
        $this->getTemplate()->mainMenuItems = $menu->getMenu();
    }

    public function renderDefault(): void
    {
        $this->getTemplate()->title = 'Domácí stránka';

    }

    public function actionSignIn(): void
    {
        $this->getTemplate()->title = 'Přihlášení';

    }

    public function actionRegistration()
    {
        $this->getTemplate()->title = 'Registrace';
        $this->getTemplate()->kytka = 'kytka'.rand(1,4).'.jpeg';

    }
    public function actionRegistered(): void
    {
        $this->getTemplate()->title = 'Registrace proběhla v pořádku';
        $vrf = $this->getPresenter()->getParameter('vrf');

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
            $this->getPresenter()->flashMessage('Email nebo heslo jsou špatně', 'alert-warning');

        }
    }

    public function createComponentRegisterForm(): Form
    {
        $form = (new registerFormFactory($this->usersRepository, $this->entityManager))->create();
        $form->onSuccess[] = [$this, 'formRegisterSucceeded'];
        return $form;
    }

    public function formRegisterSucceeded(Form $form, \stdClass $values):void
    {
        if($values->userName === $this->usersRepository->getUserByUserName($values->username) || $values->email === $this->usersRepository->getUserByEmail($values->email) && $values->password === $values->password2)
        {
            $form->addError('Hesla nejsou stejná, nebo některý z údajů je již registrován!');
        }
        else {
            try {
                $this->usersRepository->addUser($values->username, $values->email, $this->passwords->hash($values->password));
                $user = new UsersRepository($this->entityManager,Users::class);
                $user->setUsername($values->username);
                $user->setEmail($values->email);
                $user->setPassword($this->passwords->hash($values->password));
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                //odeslání emailu s odkazem


                $this->getPresenter()->flashMessage('Registrace proběhla v pořádku, do Emailu Vám přijde potvrzovací odkaz! Kdyby nedorazil, zkuste se podívat do Spamu. :-)', 'alert-success');
                $this->getPresenter()->redirect('Home:Registered');
            } catch (AuthenticationException $e) {
                $form->addError('Registrace se nezdařila možná jméno nebo email jsou již registrovány');
            }
        }

    }

}
