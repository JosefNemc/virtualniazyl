<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm\Repository\PageRepository;
use App\Model\Services\Menu;
use Contributte\Application\UI\BasePresenter;

class PagePresenter extends BasePresenter
{
    public PageRepository $pageRepository;
    public function __construct(PageRepository $pageRepository)
    {

        parent::__construct();
        $this->pageRepository = $pageRepository;
    }

    public function startup(): void
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
        if(!$page) {
            $this->flashMessage('Stránka nebyla nalezena.', 'danger');
            $this->redirect('Homepage:default');
        }
        else
        {


            $this->getTemplate()->content =  $page->getContent();
            $this->getTemplate()->title = $page->getTitle();
            $this->getTemplate()->kytka = 'kytka'.rand(1,4).'.jpeg';
            $this->setView('default');
        }
    }
}