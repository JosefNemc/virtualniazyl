<?php

declare(strict_types=1);

namespace App\Components\Datagrids;

use App\Repository\SpeciesRepository;
use Ublaboo\DataGrid\DataGrid;

class SpeciesDatagridFactory extends DataGrid
{
    private SpeciesRepository $speciesRepository;

    public function __construct(SpeciesRepository $speciesRepository)
    {
        parent::__construct();
        $this->speciesRepository = $speciesRepository;
    }

    public function create(): DataGrid
    {
        $grid = new DataGrid;
        $grid->setRememberState(false);
        $grid->setDataSource($this->speciesRepository->findAll());

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