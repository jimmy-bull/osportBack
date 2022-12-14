<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2021
 */


namespace Aimeos\Client\Html\Cms\Page\Cataloglist;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;
	private $context;


	protected function setUp() : void
	{
		$this->context = \TestHelperHtml::getContext()->setView( \TestHelperHtml::getView() );

		$this->object = new \Aimeos\Client\Html\Cms\Page\Cataloglist\Standard( $this->context );
		$this->object->setView( \TestHelperHtml::getView() );
	}


	protected function tearDown() : void
	{
		unset( $this->object );
	}


	public function testAddData()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'catalog' );
		$catId1 = $manager->find( 'cafe' )->getId();
		$catId2 = $manager->find( 'new' )->getId();

		$view = $this->object->getView();
		$view->pageCmsItem = \Aimeos\MShop::create( $this->context, 'cms' )->find( '/catlist', ['text'] );

		$textItems = $view->pageCmsItem->getRefItems( 'text', 'content' )->map( function( $item ) {
			$data = ( $json = json_decode( $item->getContent(), true ) ) ? $json['html'] : $item->getContent();
			return '<div class="cms-content>' . $data . '</div>';
		} )->all();

		$this->assertEquals( 1, count( $textItems ) );

		foreach( $textItems as $textItem ) {
			$textItem = str_replace( ['_cat1_', '_cat2_'], [$catId1, $catId2], $textItem );
		}

		$view->pageContent = $textItems;

		$view = $this->object->addData( $view );

		foreach( $view->pageContent as $text )
		{
			$this->assertStringContainsString( '<div class="catalog-list">', $text );
			$this->assertStringContainsString( 'class="list-items', $text );
		}
	}


	public function testGetSubClient()
	{
		$this->expectException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( 'invalid', 'invalid' );
	}


	public function testModifyBody()
	{
		$output = 'BEFORE<!-- catalog.lists.items.csrf -->CSRF<!-- catalog.lists.items.csrf -->AFTER';

		$output = $this->object->modifyBody( $output, 1 );

		$this->assertStringContainsString( '<input class="csrf-token" type="hidden" name="_csrf_token" value="_csrf_value"', $output );
	}
}
