<?php

namespace AnnotateCms\Themes\DI;


use AnnotateCms\Themes\Loaders\ThemesLoader;
use Kdyby\Events\DI\EventsExtension;
use Nette\DI\CompilerExtension;


class ThemesExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$configuration = $this->getConfig($this->getDefaults());

		$this->getContainerBuilder()->addDefinition($this->prefix('themeLoader'))
			->setClass(ThemesLoader::CLASSNAME, ['themesDir' => $configuration['directory']])
			->addTag(EventsExtension::TAG_SUBSCRIBER)
			->addSetup('setFrontendTheme', ['name' => $configuration['frontend']])
			->addSetup('setBackendTheme', ['name' => $configuration['backend']]);
	}


	public function  getDefaults()
	{
		return [
			'directory' => '%appDir%/addons/themes/',
			'frontend'  => '',
			'backend'   => '',
		];
	}

}
