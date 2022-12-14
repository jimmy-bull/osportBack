<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2021
 */


namespace Aimeos\Client\Html\Catalog\Lists;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;
	private $context;


	protected function setUp() : void
	{
		$this->context = \TestHelperHtml::getContext();

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $this->context );
		$this->object->setView( \TestHelperHtml::getView() );
	}


	protected function tearDown() : void
	{
		unset( $this->object );
	}


	public function testGetHeader()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_catid' => $this->getCatalogItem()->getId() ) );
		$view->addHelper( 'param', $helper );

		$tags = [];
		$expire = null;

		$this->object->setView( $this->object->addData( $view, $tags, $expire ) );
		$output = $this->object->getHeader();

		$this->assertStringContainsString( '<title>Kaffee | Aimeos</title>', $output );
		$this->assertEquals( '2098-01-01 00:00:00', $expire );
		$this->assertEquals( 5, count( $tags ) );
	}


	public function testGetHeaderSearch()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_search' => '<b>Search result</b>' ) );
		$view->addHelper( 'param', $helper );

		$tags = [];
		$expire = null;

		$this->object->setView( $this->object->addData( $view, $tags, $expire ) );
		$output = $this->object->getHeader();

		$this->assertRegexp( '#<title>[^>]*Search result[^<]* | Aimeos</title>#', $output );
		$this->assertEquals( null, $expire );
		$this->assertEquals( 1, count( $tags ) );
	}


	public function testGetHeaderException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'addData' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \RuntimeException() ) );

		$object->setView( \TestHelperHtml::getView() );

		$this->assertEmpty( $object->getHeader() );
	}


	public function testGetBody()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_catid' => $this->getCatalogItem()->getId() ) );
		$view->addHelper( 'param', $helper );

		$tags = [];
		$expire = null;

		$this->object->setView( $this->object->addData( $view, $tags, $expire ) );
		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list home categories coffee"', $output );

		$this->assertStringContainsString( '<div class="catalog-list-head">', $output );
		$this->assertRegExp( '#<h1>Kaffee</h1>#', $output );

		$this->assertEquals( '2098-01-01 00:00:00', $expire );
		$this->assertEquals( 5, count( $tags ) );
	}


	public function testGetBodyPagination()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, ['l_size' => 2] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
		$this->assertStringContainsString( '<nav class="pagination">', $output );
	}


	public function testBodyDefaultAttribute()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'attribute' );
		$attrId = $manager->find( 'xs', [], 'product', 'size' )->getId();

		$context = clone $this->context;
		$context->getConfig()->set( 'client/html/catalog/lists/attrid-default', $attrId );

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $context );
		$this->object->setView( \TestHelperHtml::getView() );

		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, [] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
		$this->assertRegExp( '#.*Cafe Noire Cappuccino.*#smu', $output );
		$this->assertRegExp( '#.*Cafe Noire Expresso.*#smu', $output );
	}


	public function testBodyNoDefaultCat()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, [] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
		$this->assertNotRegExp( '#.*U:TESTPSUB01.*#smu', $output );
		$this->assertNotRegExp( '#.*U:TESTSUB03.*#smu', $output );
		$this->assertNotRegExp( '#.*U:TESTSUB04.*#smu', $output );
		$this->assertNotRegExp( '#.*U:TESTSUB05.*#smu', $output );
	}


	public function testGetBodyDefaultCat()
	{
		$context = clone $this->context;
		$context->getConfig()->set( 'client/html/catalog/lists/catid-default', $this->getCatalogItem()->getId() );

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $context );
		$this->object->setView( \TestHelperHtml::getView() );

		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, [] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list home categories coffee"', $output );
	}


	public function testGetBodyMultipleDefaultCat()
	{
		$context = clone $this->context;
		$catid = $this->getCatalogItem()->getId();
		$context->getConfig()->set( 'client/html/catalog/lists/catid-default', array( $catid, $catid ) );

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $context );
		$this->object->setView( \TestHelperHtml::getView() );

		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, [] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list home categories coffee"', $output );
	}


	public function testGetBodyMultipleDefaultCatString()
	{
		$context = clone $this->context;
		$catid = $this->getCatalogItem()->getId();
		$context->getConfig()->set( 'client/html/catalog/lists/catid-default', $catid . ',' . $catid );

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $context );
		$this->object->setView( \TestHelperHtml::getView() );

		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, [] );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list home categories coffee"', $output );
	}


	public function testGetBodyCategoryLevels()
	{
		$context = clone $this->context;
		$context->getConfig()->set( 'client/html/catalog/lists/levels', \Aimeos\MW\Tree\Manager\Base::LEVEL_TREE );

		$this->object = new \Aimeos\Client\Html\Catalog\Lists\Standard( $context );
		$this->object->setView( \TestHelperHtml::getView() );

		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_catid' => $this->getCatalogItem( 'root' )->getId() ) );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertRegExp( '#.*Cafe Noire Cappuccino.*#smu', $output );
		$this->assertRegExp( '#.*Cafe Noire Expresso.*#smu', $output );
		$this->assertRegExp( '#.*Unittest: Bundle.*#smu', $output );
		$this->assertRegExp( '#.*Unittest: Test priced Selection.*#smu', $output );
	}


	public function testGetBodySearchText()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_search' => '<b>Search result</b>' ) );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
		$this->assertStringContainsString( '&lt;b&gt;Search result&lt;/b&gt;', $output );
	}


	public function testGetBodySearchAttribute()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_attrid' => array( -1, -2 ) ) );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
	}


	public function testGetBodySearchSupplier()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'f_supid' => array( -1, -2 ) ) );
		$view->addHelper( 'param', $helper );

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos catalog-list', $output );
	}


	public function testGetBodyHtmlException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'addData' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\Client\Html\Exception( 'test exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$this->assertStringContainsString( 'test exception', $object->getBody() );
	}


	public function testGetBodyFrontendException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'addData' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\Controller\Frontend\Exception( 'test exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$this->assertStringContainsString( 'test exception', $object->getBody() );
	}


	public function testGetBodyMShopException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'addData' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\MShop\Exception( 'test exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$this->assertStringContainsString( 'test exception', $object->getBody() );
	}


	public function testGetBodyException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'addData' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \RuntimeException( 'test exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$this->assertStringContainsString( 'A non-recoverable error occured', $object->getBody() );
	}


	public function testGetSubClient()
	{
		$client = $this->object->getSubClient( 'items', 'Standard' );
		$this->assertInstanceOf( '\\Aimeos\\Client\\HTML\\Iface', $client );
	}


	public function testGetSubClientInvalid()
	{
		$this->expectException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( 'invalid', 'invalid' );
	}


	public function testGetSubClientInvalidName()
	{
		$this->expectException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( '$$$', '$$$' );
	}


	public function testProcess()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'l_type' => 'list' ) );
		$view->addHelper( 'param', $helper );

		$this->object->process();

		$this->assertEmpty( $this->object->getView()->get( 'listErrorList' ) );
	}


	public function testProcessHtmlException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'getClientParams' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'getClientParams' )
			->will( $this->throwException( new \Aimeos\Client\Html\Exception( 'text exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$object->process();

		$this->assertIsArray( $object->getView()->listErrorList );
	}


	public function testProcessFrontendException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'getClientParams' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'getClientParams' )
			->will( $this->throwException( new \Aimeos\Controller\Frontend\Exception( 'text exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$object->process();

		$this->assertIsArray( $object->getView()->listErrorList );
	}


	public function testProcessMShopException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
			->setConstructorArgs( array( $this->context, [] ) )
			->setMethods( array( 'getClientParams' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'getClientParams' )
			->will( $this->throwException( new \Aimeos\MShop\Exception( 'text exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$object->process();

		$this->assertIsArray( $object->getView()->listErrorList );
	}


	public function testProcessException()
	{
		$object = $this->getMockBuilder( \Aimeos\Client\Html\Catalog\Lists\Standard::class )
		->setConstructorArgs( array( $this->context, [] ) )
		->setMethods( array( 'getClientParams' ) )
		->getMock();

		$object->expects( $this->once() )->method( 'getClientParams' )
		->will( $this->throwException( new \RuntimeException( 'text exception' ) ) );

		$object->setView( \TestHelperHtml::getView() );

		$object->process();

		$this->assertIsArray( $object->getView()->listErrorList );
	}


	protected function getCatalogItem( $code = 'cafe' )
	{
		$catalogManager = \Aimeos\MShop\Catalog\Manager\Factory::create( $this->context );
		$search = $catalogManager->filter();
		$search->setConditions( $search->compare( '==', 'catalog.code', $code ) );

		if( ( $item = $catalogManager->search( $search )->first() ) === null ) {
			throw new \RuntimeException( sprintf( 'No catalog item with code "%1$s" found', $code ) );
		}

		return $item;
	}
}
