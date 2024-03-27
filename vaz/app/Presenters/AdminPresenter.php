<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Components\Datagrids\CitysDatagridFactory;
use App\Components\Datagrids\UsersDatagridFactory;
use App\Forms\PageFormFactory;
use App\Forms\PhotoUploadFormFactory;
use App\Forms\RegisterFormFactory;
use App\Forms\roleFormFactory;
use App\Forms\userDetailsFormFactory;
use App\Model\Orm\Repository\PageRepository;
use App\Model\Orm\Repository\UsersRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;


class AdminPresenter extends BasePresenter
{

    private roleFormFactory $roleFormFactory;
    private UsersRepository $usersRepository;
    private EntityManagerInterface $entityManager;

    private PageFormFactory $pageFormFactory;
    private PageRepository $pageRepository;

    public function __construct(roleFormFactory               $roleFormFactory,
                                UsersRepository               $usersRepository,
                                PageRepository                $pageRepository,
                                EntityManagerInterface        $entityManager,
                                       PageFormFactory        $pageFormFactory,
                                public UserDetailsFormFactory $userDetailsFormFactory,
                                public registerFormFactory    $registerFormFactory,
                                public PhotoUploadFormFactory $photoUploadFormFactory,
                                public UsersDatagridFactory $usersDatagridFactory,
                                public CitysDatagridFactory $citysDatagridFactory)
    {
        parent::__construct();
        $this->roleFormFactory = $roleFormFactory;
        $this->usersRepository = $usersRepository;
        $this->entityManager = $entityManager;
        $this->photoUploadFormFactory = $photoUploadFormFactory;
        $this->pageFormFactory = $pageFormFactory;
        $this->pageRepository = $pageRepository;
        $this->usersDatagridFactory = $usersDatagridFactory;
        $this->citysDatagridFactory = $citysDatagridFactory;

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

    public function renderCitys(): void
    {
        $this->template->title = 'Citys';
    }

    public function actionPages(?int $id): void
    {
        $this->getTemplate()->Title = 'Pages';
        if ($id !== null) {
            $page = $this->pageRepository->find($id);
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
    public function createComponentPageForm(): Form
    {
        $form = $this->pageFormFactory->create();
        $form->onSuccess[] = [$this, 'pageFormSucceeded'];
        return $form;
    }
    public function pageFormSucceeded(Form $form, \stdClass $values):void
    {
        if ($values->id) {
            $page = $this->pageRepository->find($values->id);
            if ($page) {
                $page->setLink($values->link);
                $page->setVisibleFrom($values->visibleFrom);
                $page->setTitle($values->title);
                $page->setContent($values->content);
                $page->setImportant($values->important);
                $page->setGlobal($values->global);
                $this->pageRepository->updatePage($page);
                $this->flashMessage('Stránka byla aktualizována.', 'success');
                $this->redirect('Admin:pages');
            }
        } else {
            $page = new Pages();
            $page->setCreated(new DateTimeImmutable());
            $page->setUser($this->getUser()->getIdentity()->getData()->getUser());
            $page->setLink($values->link);
            $page->setVisibleFrom($values->visibleFrom);
            $page->setTitle($values->title);
            $page->setContent($values->content);
            $page->setImportant($values->important);
            $page->setGlobal($values->global);
            $this->pageRepository->addPage($page);
            $this->flashMessage('Stránka byla uložena.', 'success');
            $this->redirect('Admin:pages');

        }


    }

    public function createComponentUsersDatagrid(): DataGrid
    {
        $grid = $this->usersDatagridFactory->create();
        return $grid;
    }

    public function createComponentCitysDatagrid(): DataGrid
    {
        $grid = $this->citysDatagridFactory->create();
        return $grid;
    }


}

