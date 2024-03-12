<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Doctrine\DBAL\Types\Type;
class Bootstrap
{
    public function __construct()
    {
        Type::addType('roleTypeEnum', 'App\Model\Orm\Enums\RoleTypeEnum');
        Type::addType('messageTypeEnum', 'App\Model\Orm\Enums\MessageType');
        Type::addType('actionTypeEnum', 'App\Model\Orm\Enums\ActionTypeEnum');
        Type::addType('adoptionsTypeEnum', 'App\Model\Orm\Enums\AdoptionsTypeEnum');
        Type::addType('sexTypeEnum', 'App\Model\Orm\Enums\SexTypeEnum');

    }

	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		$configurator->setDebugMode(true);

		$configurator->enableTracy($appDir . '/log');

		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/local.neon');

		return $configurator;
	}
}
