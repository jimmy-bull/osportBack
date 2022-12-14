<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2021
 * @package Controller
 * @subpackage Jobs
 */


namespace Aimeos\Controller\Jobs\Order\Service\Transfer;


/**
 * Order service transfer controller factory.
 *
 * @package Controller
 * @subpackage Jobs
 */
class Factory
	extends \Aimeos\Controller\Jobs\Common\Factory\Base
	implements \Aimeos\Controller\Jobs\Common\Factory\Iface
{
	/**
	 * Creates a new controller specified by the given name.
	 *
	 * @param \Aimeos\MShop\Context\Item\Iface $context Context object required by controllers
	 * @param \Aimeos\Bootstrap $aimeos \Aimeos\Bootstrap object
	 * @param string|null $name Name of the controller or "Standard" if null
	 * @return \Aimeos\Controller\Jobs\Iface New controller object
	 */
	public static function create( \Aimeos\MShop\Context\Item\Iface $context, \Aimeos\Bootstrap $aimeos, string $name = null ) : \Aimeos\Controller\Jobs\Iface
	{
		/** controller/jobs/order/service/transfer/name
		 * Class name of the used order service transfer scheduler controller implementation
		 *
		 * Each default job controller can be replace by an alternative imlementation.
		 * To use this implementation, you have to set the last part of the class
		 * name as configuration value so the controller factory knows which class it
		 * has to instantiate.
		 *
		 * For example, if the name of the default class is
		 *
		 *  \Aimeos\Controller\Jobs\Order\Service\Transfer\Standard
		 *
		 * and you want to replace it with your own version named
		 *
		 *  \Aimeos\Controller\Jobs\Order\Service\Transfer\Mytransfer
		 *
		 * then you have to set the this configuration option:
		 *
		 *  controller/jobs/order/service/transfer/name = Mytransfer
		 *
		 * The value is the last part of your own class name and it's case sensitive,
		 * so take care that the configuration value is exactly named like the last
		 * part of the class name.
		 *
		 * The allowed characters of the class name are A-Z, a-z and 0-9. No other
		 * characters are possible! You should always start the last part of the class
		 * name with an upper case character and continue only with lower case characters
		 * or numbers. Avoid chamel case names like "MyTransfer"!
		 *
		 * @param string Last part of the class name
		 * @since 2014.07
		 * @category Developer
		 */
		if( $name === null ) {
			$name = $context->getConfig()->get( 'controller/jobs/order/service/transfer/name', 'Standard' );
		}

		$iface = '\\Aimeos\\Controller\\Jobs\\Iface';
		$classname = '\\Aimeos\\Controller\\Jobs\\Order\\Service\\Transfer\\' . $name;

		if( ctype_alnum( $name ) === false ) {
			throw new \Aimeos\Controller\Jobs\Exception( sprintf( 'Invalid characters in class name "%1$s"', $classname ) );
		}

		$controller = self::createController( $context, $aimeos, $classname, $iface );

		/** controller/jobs/order/service/transfer/decorators/excludes
		 * Excludes decorators added by the "common" option from the order service transfer controllers
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "controller/jobs/common/decorators/default" before they are wrapped
		 * around the job controller.
		 *
		 *  controller/jobs/order/service/transfer/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Controller\Jobs\Common\Decorator\*") added via
		 * "controller/jobs/common/decorators/default" to this job controller.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see controller/jobs/common/decorators/default
		 * @see controller/jobs/order/service/transfer/decorators/global
		 * @see controller/jobs/order/service/transfer/decorators/local
		 */

		/** controller/jobs/order/service/transfer/decorators/global
		 * Adds a list of globally available decorators only to the order service transfer controllers
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Controller\Jobs\Common\Decorator\*") around the job controller.
		 *
		 *  controller/jobs/order/service/transfer/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Controller\Jobs\Common\Decorator\Decorator1" only to this job controller.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see controller/jobs/common/decorators/default
		 * @see controller/jobs/order/service/transfer/decorators/excludes
		 * @see controller/jobs/order/service/transfer/decorators/local
		 */

		/** controller/jobs/order/service/transfer/decorators/local
		 * Adds a list of local decorators only to the order service transfer controllers
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Controller\Jobs\Order\Service\Transfer\Decorator\*") around this job controller.
		 *
		 *  controller/jobs/order/service/transfer/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Controller\Jobs\Order\Service\Transfer\Decorator\Decorator2" only to this job
		 * controller.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see controller/jobs/common/decorators/default
		 * @see controller/jobs/order/service/transfer/decorators/excludes
		 * @see controller/jobs/order/service/transfer/decorators/global
		 */
		return self::addControllerDecorators( $context, $aimeos, $controller, 'order/service/transfer' );
	}
}
