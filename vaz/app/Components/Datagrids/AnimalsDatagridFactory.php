<?php

declare(strict_types=1);

namespace App\Components\Datagrids;

use App\Model\Orm\Repository\AnimalsRepository;
use Ublaboo\DataGrid\DataGrid;


class AnimalsDatagridFactory extends DataGrid
{
    private AnimalsRepository $animalsRepository;

    public function __construct(AnimalsRepository $animalsRepository)
    {
        parent::__construct();
        $this->animalsRepository = $animalsRepository;
    }

    public function create(): DataGrid
    {
        $grid = new DataGrid;
        $grid->setRememberState(false);
        $grid->setDataSource($this->animalsRepository->findAll());

        $grid->addColumnText('species', 'Druh')
            ->setFilterText();
        $grid->addColumnText('breed', 'Plemeno')
            ->setFilterText();
        $grid->addColumnText('azyl', 'Azyl')
             ->setRenderer(function ($item) {return $item->getAzyl()->getAzylName();
             }
             );

        return $grid;
    }
}