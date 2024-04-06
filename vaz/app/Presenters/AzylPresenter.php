<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\animalFormFactory;
use App\Model\Orm\Entity\Animal;
use App\Model\Orm\Enums\RoleTypeEnum;
use App\Model\Orm\Repository\AnimalsRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;
use Nette\Forms\Form;

class AzylPresenter extends BasePresenter
{
    private AnimalsRepository $animalsRepository;
    private AnimalFormFactory $animalFormFactory;

    public function __construct(AnimalsRepository $animalsRepository, AnimalFormFactory $animalFormFactory)
    {
        $this->animalsRepository = $animalsRepository;
        $this->animalFormFactory = $animalFormFactory;
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

    public function animalFormSucceeded(Form $form, $values): void
    {
        bdump($values);

        $id = $this->getParameter('id');
        if ($id === null)
        {
            $animal = New Animal();
            $animal->setAzyl($this->getUser()->getIdentity()->getId());
            $animal->setIsDeleted(false);
            $animal->setAdopted(false);
            $animal->setName($values->name);
            $animal->setDescription($values->description);
            $animal->setSpecies($values->species);
            $animal->setBirthDate($values->birthDate);
            $animal->setBreed($values->breed);

            //$animal->setPhotos([]);


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
}