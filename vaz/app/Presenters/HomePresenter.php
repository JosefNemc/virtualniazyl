<?php

declare(strict_types=1);

namespace App\Presenters;

use AllowDynamicProperties;
use App\Forms\registerFormFactory;
use App\Forms\SignInFormFactory;
use App\Model\Orm\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Nette\Forms\Form;


#[AllowDynamicProperties] final class HomePresenter extends Nette\Application\UI\Presenter
{
    protected EntityManagerInterface $entityManager;
    protected UsersRepository $usersRepository;


    public function __construct(UsersRepository $usersRepository, EntityManagerInterface $entityManager,  protected readonly SignInFormFactory $signInFormFactory, protected readonly RegisterFormFactory $registerFormFactory)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->usersRepository = $usersRepository;

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

    public function createComponentSignInForm(): Form
    {
        return $form = (new SignInFormFactory())->create();
    }

    public function createComponentRegisterForm(): RegisterFormFactory
    {
        return new $this->registerFormFactory->create();
    }
}
