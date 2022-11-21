<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2021
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Checkout\Standard\Process\Account;

use \Aimeos\MW\Logger\Base as Log;


/**
 * Default implementation of checkout process account HTML client
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/checkout/standard/process/account/subparts
	 * List of HTML sub-clients rendered within the checkout standard process account section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2015.09
	 * @category Developer
	 */
	private $subPartPath = 'client/html/checkout/standard/process/account/subparts';
	private $subPartNames = [];


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( string $uid = '' ) : string
	{
		$view = $this->getView();

		$html = '';
		foreach( $this->getSubClients() as $subclient ) {
			$html .= $subclient->setView( $view )->getBody( $uid );
		}

		return $html;
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( string $type, string $name = null ) : \Aimeos\Client\Html\Iface
	{
		/** client/html/checkout/standard/process/account/decorators/excludes
		 * Excludes decorators added by the "common" option from the checkout standard process account html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/checkout/standard/process/account/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/process/account/decorators/global
		 * @see client/html/checkout/standard/process/account/decorators/local
		 */

		/** client/html/checkout/standard/process/account/decorators/global
		 * Adds a list of globally available decorators only to the checkout standard process account html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/checkout/standard/process/account/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/process/account/decorators/excludes
		 * @see client/html/checkout/standard/process/account/decorators/local
		 */

		/** client/html/checkout/standard/process/account/decorators/local
		 * Adds a list of local decorators only to the checkout standard process account html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Checkout\Decorator\*") around the html client.
		 *
		 *  client/html/checkout/standard/process/account/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Checkout\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.09
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/checkout/standard/process/account/decorators/excludes
		 * @see client/html/checkout/standard/process/account/decorators/global
		 */

		return $this->createSubClient( 'checkout/standard/process/account/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. provides the account form.
	 *
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables.
	 */
	public function process()
	{
		$context = $this->getContext();

		try
		{
			$type = \Aimeos\MShop\Order\Item\Base\Address\Base::TYPE_PAYMENT;
			$addresses = \Aimeos\Controller\Frontend::create( $context, 'basket' )->get()->getAddress( $type );

			if( $context->getUserId() == null && ( $address = current( $addresses ) ) !== false )
			{
				$create = (bool) $this->getView()->param( 'cs_option_account' );
				$userId = $this->getCustomerId( $address, $create );
				$context->setUserId( $userId );
			}
		}
		catch( \Exception $e )
		{
			$msg = sprintf( 'Unable to create an account: %1$s', $e->getMessage() );
			$context->getLogger()->log( $msg, Log::NOTICE, 'client/html' );
		}

		parent::process();
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames() : array
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Creates a new account (if necessary) and returns its customer ID
	 *
	 * @param \Aimeos\MShop\Common\Item\Address\Iface $addr Address object from order
	 * @param bool $new True to create the customer if it doesn't exist, false if not
	 * @return string|null Unique customer ID or null if no customer is available
	 */
	protected function getCustomerId( \Aimeos\MShop\Common\Item\Address\Iface $addr, bool $new ) : ?string
	{
		$context = $this->getContext();
		$cntl = \Aimeos\Controller\Frontend::create( $context, 'customer' );

		try {
			$id = $cntl->find( $addr->getEmail() )->getId();
		} catch( \Exception $e ) {
			$id = $new ? $cntl->add( $addr->toArray() )->store()->get()->getId() : null;
		}

		return $id;
	}
}
