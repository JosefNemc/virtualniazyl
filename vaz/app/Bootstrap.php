<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Doctrine\DBAL\Types\Type;

Type::addType('roleTypeEnum', 'App\Model\Orm\Enums\RoleTypeEnum');
/*
Type::addType('messageType', 'App\Model\Orm\Enums\MessageType');
Type::addType('adoptionsType', 'App\Model\Orm\Enums\AdoptionsType');
Type::addType('actionType', 'App\Model\Orm\Enums\ActionType');
*/
class Bootstrap
{

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
