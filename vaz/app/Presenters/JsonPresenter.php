<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Model\Orm\Entity\Citys;
use App\Model\Orm\Repository\CityRepository;
use Nette\Application\UI\Presenter;

class JsonPresenter extends Presenter
{


    private CityRepository $cityRepository;

    public function __construct(public Citys $citys, CityRepository $cityRepository)
    {
        parent::__construct();
        $this->cityRepository = $cityRepository;
        $this->citys = $citys;

    }

    public function actionCities($regionarray): void
    {
        $cities = $this->Citys->getCityFromRegion($regionarray);
        $this->sendJson($cities);
    }

    public function actionStates(): void
    {
        $states = $this->cityRepository->fetchStates();
    }
}

