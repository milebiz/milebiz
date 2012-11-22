<?php
/*
* ___COPY__RIGHT___
*/

/**
 * Controllers don't need to be loaded with includeController anymore since they use Autoload
 *
 * @deprecated since 1.5.0
 */
class ControllerFactoryCore
{
	/**
	 * @deprecated since 1.5.0
	 */
	public static function includeController($className)
	{
		Tools::displayAsDeprecated();

		if (!class_exists($className, false))
		{
			require_once(dirname(__FILE__).'/../controllers/'.$className.'.php');
			if (file_exists(dirname(__FILE__).'/../override/controllers/'.$className.'.php'))
				require_once(dirname(__FILE__).'/../override/controllers/'.$className.'.php');
			else
			{
				$coreClass = new ReflectionClass($className.'Core');
				if ($coreClass->isAbstract())
					eval('abstract class '.$className.' extends '.$className.'Core {}');
				else
					eval('class '.$className.' extends '.$className.'Core {}');
			}
		}
	}

	/**
	 * @deprecated since 1.5.0
	 */
	public static function getController($className, $auth = false, $ssl = false)
	{
		ControllerFactory::includeController($className);
		return new $className($auth, $ssl);
	}
}