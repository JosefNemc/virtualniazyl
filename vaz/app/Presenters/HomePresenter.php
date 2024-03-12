<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\registerFormFactory;
use App\Forms\SignInFormFactory;
use Contributte\FormsBootstrap\BootstrapForm;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Nette\Forms\Form;


final class HomePresenter extends Nette\Application\UI\Presenter
{
    protected EntityManagerInterface $entityManager;


    public function __construct(EntityManagerInterface $entityManager, protected readonly SignInFormFactory $signInFormFactory, protected readonly RegisterFormFactory $registerFormFactory)
    {
        parent::__construct();
        $this->entityManager = $entityManager;

    }
    public function renderDefault(): void
    {
        $this->getTemplate()->title = 'Domácí stránka';

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
