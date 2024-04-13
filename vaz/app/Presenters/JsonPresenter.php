<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Model\Orm\Entity\Citys;
use Nette\Application\UI\Presenter;

class JsonPresenter extends Presenter
{

    public function __construct(public Citys $citys)
    {
        parent::__construct();
        $this->citys = $citys;

    }
    public function actionCities($regionarray): void
    {
        $cities = $this->Locale->getCityFromRegion($regionarray);
        $this->sendJson($cities);
    }
}

