<?php

namespace Dww\Shiprestriction\Plugin;

/**
 * phpcs:ignoreFile
 */
class LayoutProcessor
{
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        $result
    ) {
        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['price']['template'] = 'Dww_Shiprestriction/tax-price';

        return $result;
    }
}
