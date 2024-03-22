<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\roleFormFactory;
use App\Model\Orm\Enums\RoleTypeEnum;
use App\Model\Orm\Repository\UsersRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Form;


class UserPresenter extends BasePresenter
{
    private roleFormFactory $roleFormFactory;
    private UsersRepository $usersRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(roleFormFactory $roleFormFactory, UsersRepository $usersRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->roleFormFactory = $roleFormFactory;
        $this->usersRepository = $usersRepository;
        $this->entityManager = $entityManager;
    }

    public function startup(): void
    {
        parent::startup();
        $menu = new Menu();
        $this->getTemplate()->mainMenuItems = $menu->getMenu();
        if ($this->getPresenter()->getUser()->isLoggedIn() && !$this->getPresenter()->getUser()->isInRole('owner'))
        {
        }
        else
        {
            $this->redirect('Home:signIn');
        }

    }
public function actionDefault(): void
    {
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
            else
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

    public function renderFirst()
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
        if ($values->role === RoleTypeEnum::ROLE_AZYL)
        {
            $users = $this->usersRepository->getUserById($this->getPresenter()->getUser()->getId());
            $users->setRole(RoleTypeEnum::ROLE_AZYL);
            $users->setUpdatedAt(new DateTimeImmutable());
            $users->setUpdatedBy($this->usersRepository->getUserById($this->getPresenter()->getUser()->getId()));
            $this->usersRepository->addUser($users);
            $this->getPresenter()->flashMessage('Od této chvíle jste v roli Azylu!', 'alert-success');
            $this->redirect('Azyl:profil');
        }
        elseif ($values->role === RoleTypeEnum::ROLE_OWNER)
        {

            $users = $this->usersRepository->getUserById($this->getPresenter()->getUser()->getId());
            bdump($users,'USERS');
            $users->setRole(RoleTypeEnum::ROLE_OWNER);
            $users->setUpdatedAt(new DateTimeImmutable());
            $users->setUpdatedBy($this->usersRepository->getUserById($this->getPresenter()->getUser()->getId()));
            bdump($users,'USERS2');
            $this->usersRepository->addUser($users);
            bdump($users,'USERS3');
            $this->getPresenter()->flashMessage('Od této chvíle jste běžný uživatel!', 'alert-success');
            $this->redirect('User:profil');

        }

    }


}