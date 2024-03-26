<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Forms\PhotoUploadFormFactory;
use App\Forms\RegisterFormFactory;
use App\Forms\roleFormFactory;
use App\Forms\userDetailsFormFactory;
use App\Model\Orm\Repository\OwnersRepository;
use App\Model\Orm\Repository\UsersRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Form;


class AdminPresenter extends BasePresenter
{

    private roleFormFactory $roleFormFactory;
    private UsersRepository $usersRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(roleFormFactory        $roleFormFactory,
                                UsersRepository        $usersRepository,
                                EntityManagerInterface $entityManager,
                                private UserDetailsFormFactory $userDetailsFormFactory,
                                private registerFormFactory    $registerFormFactory,
                                private PhotoUploadFormFactory  $photoUploadFormFactory,
                                private OwnersRepository        $ownerRepository)
    {
        parent::__construct();
        $this->roleFormFactory = $roleFormFactory;
        $this->usersRepository = $usersRepository;
        $this->entityManager = $entityManager;
        $this->photoUploadFormFactory = $photoUploadFormFactory;
        $this->ownerRepository = $ownerRepository;
    }
    public function startup()
    {
        if (!$this->getPresenter()->getUser()->isLoggedIn())
        {
            $this->redirect('Home:singIn');
        }
        else
        {
            if (!$this->getPresenter()->getUser()->isInRole('admin') && !$this->getPresenter()->getUser()->isInRole('superadmin'))
            {
                $this->flashMessage('Nemáte dostatečná oprávnění pro tuto akci. Akce byla zalogována!', 'alert-danger');
                $this->redirect('Home:default');
            }
            else {
                parent::startup();
                $menu = new Menu();
                $this->getTemplate()->mainMenuItems = $menu->getMenu();
            }
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

    public function renderSendmessages(): void
    {
        $this->template->title = 'Sendmessage';
    }

    public function renderAdoptions(): void
    {
        $this->template->title = 'Adoptions';
    }

    public function actionPages(?int $id = null): void
    {
        if ($id !== null) {
            $page = $this->pagesRepository->find($id);
            if ($page === null) {
                $this->flashMessage('Stránka nebyla nalezena.', 'danger');
                $this->redirect('Admin:pages');
            }
            $this['pageForm']->setDefaults($page->toArray());
        }

        $this->template->title = 'Pages';
    }


    // Actions


    // Handle


    // Components
    private function createComponentPageForm(): Form
    {
        $form = $this->pageFormFacory()->create();
        return $form;
    }
}

