<?php

declare(strict_types=1);

namespace App\Presenters;

use Contributte\Application\UI\BasePresenter;

class AzylPresenter extends BasePresenter
{
    public function __construct()
    {
        if ($this->getPresenter()->user->isLoggedIn() && $this->getPresenter()->user->isInRole('azyl')) {
            $this->getPresenter()->redirect('Home:login');
        }
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->template->title = 'Azyl';
    }

    public function renderAnimals(): void
    {
        $this->template->title = 'Animals';
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
}