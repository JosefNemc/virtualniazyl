<?php
declare(strict_types=1);

namespace App\Components\Datagrids;

use App\Model\Orm\Repository\UsersRepository;
use Ublaboo\DataGrid\DataGrid;

class UsersDatagridFactory extends DataGrid
{
private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        parent::__construct();
        $this->usersRepository = $usersRepository;
    }

    public function create(): DataGrid
    {
        $grid = new DataGrid;
        $grid->setDataSource($this->usersRepository->findAll());
        $grid->addColumnText('id', 'ID')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('name', 'Name')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('email', 'Email')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('role', 'Role')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnDateTime('created_at', 'Created at')
            ->setSortable()
            ->setFilterDate();
        $grid->addAction('edit', 'Edit', 'edit')
            ->setIcon('pencil-alt')
            ->setTitle('Edit')
            ->setClass('btn btn-xs btn-primary');
        $grid->addAction('delete', 'Delete', 'delete')
            ->setIcon('trash')
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger')
            ->addAttributes(['data-confirm' => 'Skutečně chcete smazat uživatele?']);

        return $grid;
    }
}