<?php
namespace Workshop\Plugins\Test\Unit\Checkout\Block\Cart\Item;

use Workshop\Plugins\Plugin\Checkout\Block\Cart\Item\Renderer;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject | \Magento\Checkout\Block\Cart\Item\Renderer
     */
    protected $renderer;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject |  \Magento\Catalog\Model\Product
     */
    protected $product;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject | \Closure
     */
    protected $closure;

    /**
     * setup tests
     */
    protected function setUp()
    {
        $this->renderer = $this->getMock(
            \Magento\Checkout\Block\Cart\Item\Renderer::class,
            [],
            [],
            "",
            false
        );
        $this->product = $this->getMock(\Magento\Catalog\Model\Product::class, [], [], '', false);
        $this->renderer->expects($this->any())->method('getProduct')->will($this->returnValue($this->product));
        $this->closure = function() {
            return 'Original Method Called';
        };
    }

    protected function tearDown()
    {
        $this->renderer = null;
        $this->product = null;
        $this->closure = null;
    }

    public function testAroundGetProductNameForConfigurable()
    {
        $this->product->expects($this->any())->method('getTypeId')->will($this->returnValue('configurable'));
        $object = new Renderer();
        $this->assertEquals(
            'Mistery product. Click to view',
            $object->aroundGetProductName($this->renderer, $this->closure)
        );
    }

    public function testAroundGetProductNameForNonConfigurable()
    {
        $this->product->expects($this->any())->method('getTypeId')->will($this->returnValue('dummy'));
        $object = new Renderer();
        $this->assertEquals(
            'Original Method Called',
            $object->aroundGetProductName($this->renderer, $this->closure)
        );
    }
}
