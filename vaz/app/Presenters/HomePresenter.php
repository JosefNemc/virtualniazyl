<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm\Enums\RoleType;
use App\Model\Orm\Enums\RoleTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Doctrine\ORM\EntityManager;


final class HomePresenter extends Nette\Application\UI\Presenter
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }
    public function renderDefault(): void
    {
        $this->getTemplate()->title = 'Virtualní azyl';
        // $this->getTemplate()->roles = $this->entityManager->getRepository(Role::class)->findAll();

        //bdump($this->entityManager->getRepository(RoleTypeEnum::class)->findAll());
    }
}
