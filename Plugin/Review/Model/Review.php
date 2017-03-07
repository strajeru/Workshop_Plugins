<?php
namespace Workshop\Plugins\Plugin\Review\Model;

class Review
{
    public function before__call(\Magento\Review\Model\Review $review, $method, $args)
    {
        if ($method == 'setStatusId') {
            if (isset($args[0])) {
                $args[0] = \Magento\Review\Model\Review::STATUS_APPROVED;
                return [$method, $args];
            }
        }
        //leave everything unchanged
        return null;
    }
}

