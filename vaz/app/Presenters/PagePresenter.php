<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm\Repository\PageRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;

class PagePresenter extends BasePresenter
{
    private PageRepository $pageRepository;
    public function __construct(PageRepository $pageRepository)
    {
        parent::__construct();
        $this->pageRepository = $pageRepository;
    }

    public function startup()
    {
        parent::startup();
        $menu = new Menu();
        $this->getTemplate()->mainMenuItems = $menu->getMenu();

    }
    public function renderDefault(): void
    {

    }

    public function actionShow(string $link): void
    {
        $page = $this->pageRepository->findByLink($link);
        if (!$page) {
            $this->flashMessage('Stránka nebyla nalezena.', 'danger');
        }
        $this->template->page = $page;
    }

}