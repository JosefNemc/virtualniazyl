<?php
declare(strict_types=1);

namespace App\Components\Datagrids;

use App\Model\Orm\Entity\News;
use App\Model\Orm\Repository\NewsRepository;
use Ublaboo\DataGrid\DataGrid;

class NewsDatagridFactory extends DataGrid
{
    private NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        parent::__construct();
        $this->newsRepository = $newsRepository;
    }

    public function create(): DataGrid
    {
        $grid = new DataGrid;
        $grid->setDataSource($this->newsRepository->findAll());
        $grid->addColumnText('id', 'ID')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('title', 'Title')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('content', 'Content')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnDateTime('createdAt', 'Created at')
            ->setDefaultHide()
            ->setSortable()
            ->setFilterDate();
        $grid->addColumnDateTime('updatedAt', 'Updated at')
            ->setDefaultHide()
            ->setSortable()
            ->setFilterDate();
        $grid->addColumnDateTime('visibleFrom', 'Visible from')
            ->setSortable()
            ->setFilterDate();
        $grid->addColumnText('author', 'Author')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('deleted', 'Deleted')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('global', 'Global')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('important', 'Important')
            ->setSortable()
            ->setFilterText();
        $grid->addAction('edit', 'Edit', 'edit')
            ->setIcon('pencil-alt')
            ->setTitle('Edit')
            ->setClass('btn btn-xs btn-primary');
        $grid->addAction('delete', 'Delete', 'delete')
            ->setIcon('trash')
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger')
            ->addAttributes(['data-confirm' => 'Skutečně chcete smazat novinku?']);

        return $grid;
    }
}