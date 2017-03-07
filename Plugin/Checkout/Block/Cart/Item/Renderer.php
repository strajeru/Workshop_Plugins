<?php
namespace Workshop\Plugins\Plugin\Checkout\Block\Cart\Item;

class Renderer
{
    public function aroundGetProductName(
        \Magento\Checkout\Block\Cart\Item\Renderer $renderer,
        \Closure $proceed
    )
    {
        if ($renderer->getProduct()->getTypeId() == 'configurable') {
            return __('Mistery product. Click to view');
        }
        return $proceed();
    }
}
