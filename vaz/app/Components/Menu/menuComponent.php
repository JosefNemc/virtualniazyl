<?php
declare(strict_types=1);

namespace App\Componrnts\Menu;

use Nette\Application\UI\Control;
use Nette\Application\UI\Presenter;

interface IMenuComponentFactory
{
    public function create(): MenuComponent;
}

class MenuComponent extends Presenter
{
    public function render(): void
    {
        $this->template->render(__DIR__ . '/menu.latte');
    }
}

