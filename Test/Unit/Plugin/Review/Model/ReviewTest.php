<?php
namespace Workshop\Plugins\Test\Unit\Review\Model;

use Magento\Review\Model\Review;

class ReviewTest extends \PHPUnit_Framework_TestCase
{
    public function testBeforeCall()
    {
        /** @var \Magento\Review\Model\Review | \PHPUnit_Framework_MockObject_MockObject $reviewModel */
        $reviewModel = $this->getMock(\Magento\Review\Model\Review::class, [], [], '', false);
        $reviewPlugin = new \Workshop\Plugins\Plugin\Review\Model\Review();
        //test for a methods that has nothing to do with setting the status
        $this->assertNull($reviewPlugin->before__call($reviewModel, 'dummyMethod', []));
        //test for the setStatusId method and no parameters
        $this->assertNull($reviewPlugin->before__call($reviewModel, 'setStatusId', []));
        //test for setStatusId method with 1 parameter
        $expected = ['setStatusId', [Review::STATUS_APPROVED]];
        $this->assertEquals($expected, $reviewPlugin->before__call($reviewModel, 'setStatusId', [999]));
        //test for setStatusId method with multiple parameter
        $expected = ['setStatusId', [Review::STATUS_APPROVED, 8, 9, 'a']];
        $this->assertEquals($expected, $reviewPlugin->before__call($reviewModel, 'setStatusId', [999, 8, 9, 'a']));
    }
}
