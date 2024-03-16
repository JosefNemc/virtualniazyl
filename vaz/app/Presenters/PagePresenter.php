<?php
declare(strict_types=1);

namespace App\Presenters;

use Contributte\Application\UI\BasePresenter;

class PagePresenter extends BasePresenter
{
    public function __construct()
    {
    }

    public function startup()
    {
        parent::startup();
        $page = $this->presenter->getParameterId('id');

    }

    public function renderDefault(): void
    {
        $this->template->title = '';

    }

}