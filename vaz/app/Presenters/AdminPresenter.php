<?php
declare(strict_types=1);

namespace App\Presenters\Admin;

use Contributte\Application\UI\BasePresenter;
use Nette\DI\Attributes\Inject;

class AdminPresenter extends BasePresenter
{
    public function __construct()
    {
        if ($this->getPresenter()->user->isLoggedIn() && $this->getPresenter()->user->isInRole('admin')) {
            $this->getPresenter()->redirect('Home:adminLogin');
        }
        parent::__construct();
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
    // Actions


    // Handle


    // Components
}

