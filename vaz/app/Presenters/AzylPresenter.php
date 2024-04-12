<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\Datagrids\NewsDatagridFactory;
use App\Forms\animalFormFactory;
use App\Forms\azylSetingsFormFactory;
use App\Forms\newsFormFactory;
use App\Model\Orm\Entity\Animal;
use App\Model\Orm\Entity\News;
use App\Model\Orm\Enums\RoleTypeEnum;
use App\Model\Orm\Repository\AnimalsRepository;
use App\Model\Orm\Repository\NewsRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use DateTimeImmutable;
use Nette\Forms\Form;
use Ublaboo\DataGrid\DataGrid;

class AzylPresenter extends BasePresenter
{
    private AnimalsRepository $animalsRepository;
    private AnimalFormFactory $animalFormFactory;
    private AzylSetingsFormFactory $azylSetingsFormFactory;

    public function __construct(AnimalsRepository      $animalsRepository,
                                AnimalFormFactory      $animalFormFactory,
                                AzylSetingsFormFactory $azylSetingsFormFactory,
                                public NewsRepository  $newsRepository,
                                public NewsFormFactory $newsFormFactory,
                                public NewsDatagridFactory $newsDatagridFactory)
    {
        $this->animalsRepository = $animalsRepository;
        $this->animalFormFactory = $animalFormFactory;
        $this->azylSetingsFormFactory = $azylSetingsFormFactory;
        $this->newsRepository = $newsRepository;
        $this->newsFormFactory = $newsFormFactory;
        $this->newsDatagridFactory = $newsDatagridFactory;
        parent::__construct();
    }

    public function startup(): void
    {

        if (!$this->getPresenter()->getUser()->isLoggedIn()) {
            $this->redirect('Home:singIn');
        } else {
            if (!($this->getPresenter()->getUser()->isInRole('azyl') || $this->getPresenter()->getUser()->isInRole('superadmin'))) {
                $this->flashMessage('Nemáte dostatečná oprávnění pro tuto akci. Akce byla zalogována!', 'alert-danger');
                $this->redirect('Home:default');
            } else {
                parent::startup();
                $menu = new Menu();
                $this->getTemplate()->mainMenuItems = $menu->getMenu();
            }
        }
    }
    public function renderDefault(): void
    {
        $this->template->title = 'Azyl';
      //  $this->template->newUsersCount = $this->usersRepository->CountNewUsers();
      //  $this->template->usersCount = $this->usersRepository->CountUsers();
      //  $this->template->azylsCount = $this->usersRepository->CountAzyls();
    }

    public function renderAnimals(): void
    {
        $this->template->title = 'Animals';
    }

    public function actionAnimal(?int $id = null): void
    {
        if ($id === null)
        {
            $this->getTemplate()->title = 'Azyl - Přidání nového zvířátka';
        }
        else {
            if (!$animal = $this->animalsRepository->findById($id)) {
                $this->getTemplate()->title = 'Azyl - Přidání nového zvířátka';

            }
            else
            {   $this->getTemplate()->photos = $animal->getPhotos();
                $this->getTemplate()->title = 'Azyl - Editace zvířátka';
                $this['animalForm']->setDefaults($animal);
            }
        }
    }

    public function renderNews(): void
    {
        $this->template->title = 'News';
    }

    public function renderPhotos(): void
    {
        $this->template->title = 'Photos';
    }

    public function renderMessages(): void
    {
        $this->template->title = 'Message';
    }

    public function renderSettings(): void
    {
        $this->template->title = 'Settings';
    }

    public function renderAdoptions(): void
    {
        $this->template->title = 'Adoptions';
    }

    // Actions

    // Handle

    // Components

    public function createComponentAnimalForm(): Form
    {
        $form = $this->animalFormFactory->create();
        $form->onSuccess[] = [$this, 'animalFormSucceeded'];
        return $form;
    }

    public function createComponentAzylSettingsForm(): Form
    {
        $form = $this->azylSetingsFormFactory->create();
        $form->setDefaults($this->getUser()->getIdentity()->data['Azyl']);
        $form->onSuccess[] = [$this, 'azylSettingsFormSucceeded'];
        return $form;
    }

    public function azylSettingsFormSucceeded(Form $form, $values) :void
    {

    }

    public function animalFormSucceeded(Form $form, $values): void
    {
        $id = $this->getParameter('id');
        //todo: ověření práv uživatele na úpravu zvířátka
        if ($id === null)
        {
            bdump($values);
            $animal = New Animal();
            $animal->setAzyl($this->getUser()->getIdentity()->getId());
            $animal->setIsDeleted(false);
            $animal->setAdopted(false);
            $animal->setName($values->name);
            $animal->setDescription($values->description);
            $animal->setSpecies($values->species);
            $animal->setBirthDate($values->birthDate);
            $animal->setBreed($values->breed);
            foreach ($values->photos as $photo)
            {

            }
            $animal->setPhotos([]);


            $this->animalsRepository->saveAnimal($values);
            $this->flashMessage('Zvířátko bylo úspěšně přidáno.', 'alert-success');
        }
        else
        {
            $animal = $this->animalsRepository->findById($id);

            $animal->setName($values->name);
            $animal->setDescription($values->description);
            $animal->setSpecies($values->species);
            $animal->setBirthDate($values->birthDate);
            $animal->setBreed($values->breed);
            //$animal->setPhotos([]);

            $this->animalsRepository->saveAnimal($values);
            $this->flashMessage('Zvířátko bylo úspěšně upraveno.', 'alert-success');
        }
        $this->redirect('Azyl:animals');
    }

    public function createComponentNewsForm(): \Nette\Application\UI\Form
    {
        $form = $this->newsFormFactory->create();
        $form->onSuccess[] = [$this, 'newsFormSucceeded'];
        return $form;
    }

    public function newsFormSucceeded(Form $form, \stdClass $values): void
    {
        if ($this->getPresenter()->getParameter('id') !== null) {
            $news = $this->newsRepository->findOneBy(['id' => $this->getPresenter()->getParameter('id')]);
            if ($news) {
                $news->setTitle($values->title);
                $news->setContent($values->content);
                $news->setGlobal($values->global);
                $news->setVisibleFrom($values->visibleFrom);
                $news->setUpdatedAt(new DateTimeImmutable());
                $news->setDeleted($values->deleted);
                $news->setImportant($values->important);
                $this->newsRepository->save($news);
                $this->flashMessage('Novinka byla aktualizována.', 'success');
                $this->redirect('Azyl:news');
            }
        } else {
            bdump ($values);
            $news = new News();
            $data = $this->getPresenter()->getUser()->getIdentity()->getData();
            $news->setAuthor($data['User']);
            $news->setTitle($values->title);
            $news->setContent($values->content);
            $news->setGlobal($values->global);
            $news->setVisibleFrom($values->visibleFrom);
            $news->setImportant($values->important);
            $news->setCreatedAt(new DateTimeImmutable());
            $news->setDeleted(false);
            $news->setImportant(false);
            $this->newsRepository->save($news);
            $this->flashMessage('Novinka byla uložena.', 'success');
            $this->redirect('Azyl:news');
        }
    }

    public function createComponentNewsDatagrid(): DataGrid
    {
        $grid = $this->newsDatagridFactory->create();
        return $grid;
    }
}