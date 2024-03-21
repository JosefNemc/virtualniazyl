<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\roleFormFactory;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use Nette\Application\UI\Form;


class UserPresenter extends BasePresenter
{
    private roleFormFactory $roleFormFactory;

    public function __construct(roleFormFactory $roleFormFactory)
    {
        parent::__construct();
        $this->roleFormFactory = $roleFormFactory;
    }

    private function __startup():void
    {
        parent::startup();
        $menu = new Menu();
        $this->getTemplate()->mainMenuItems = $menu->getMenu();

        if ($this->getPresenter()->getUser()->isLoggedIn())
        {
            if ($this->getPresenter()->getUser()->isInRole('user'))
            {
                $this->getPresenter()->redirect('User:first');
            }
            elseif ($this->getPresenter()->getUser()->isInRole('owner'))
            {
                $this->getPresenter()->redirect('User:profil');
            }
            {
                $this->getPresenter()->redirect('Home:default');
            }
        }
        else
        {
              $this->redirect('Home:signIn');
        }

    }
    public function renderDefault(): void
    {

        $this->template->title = 'Admin';
    }

    public function renderAnimals(): void
    {
        $this->template->title = 'Animals';
    }

    public function renderAzyls(): void
    {
        $this->template->title = 'Azyls';
    }

    public function renderNews(): void
    {
        $this->template->title = 'News';
    }

    public function renderOwner(): void
    {
        $this->template->title = 'Owner';
    }

    public function renderMessages(): void
    {
        $this->template->title = 'Zprávy';
    }

    public function renderAdoptions(): void
    {
        $this->template->title = 'Adoptions';
    }
    // Actions

    public function actionFirst()
    {
        $this->template->title = 'Vyberte si roli';

    }

    public function createComponentRoleForm(): Form
    {
        $form = $this->roleFormFactory->create();
        $form->onSuccess[] = [$this, 'roleFormSucceeded'];
        return $form;
    }

    public function roleFormSucceeded(Form $form, \stdClass $values): void
    {
        if ($values->role === 'azyl')
        {
            $users = $this->usersRepository->getUserById($this->getUser()->getId());
            $users->setRole('azyl');
            $this->entityManager->persist($users);
            $this->entityManager->flush();
            $this->getPresenter()->flashMessage('Od této chvíle jste v roli Azylu!', 'alert-success');
            $this->redirect('Azyl:profil');
        }
        elseif ($values->role === 'owner')
        {
            $users = $this->usersRepository->getUserById($this->getUser()->getId());
            $users->setRole('owner');
            $this->entityManager->persist($users);
            $this->entityManager->flush();
            $this->getPresenter()->flashMessage('Od této chvíle jste běžný uživatel!', 'alert-success');
            $this->redirect('Owner:profil');

        }

    }


}