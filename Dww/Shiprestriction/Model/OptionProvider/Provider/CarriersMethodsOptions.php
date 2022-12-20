<?php
namespace Dww\Shiprestriction\Model\OptionProvider\Provider;

use Dww\Shiprestriction\Model\MethodConverter;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Option\ArrayInterface;

/**
 * Return array of carriers with methods optgroup
 */
class CarriersMethodsOptions implements ArrayInterface
{
    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    protected $shippingConfig;

    /**
     * @var MethodConverter
     */
    protected $methodConverter;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Shipping\Model\Config $shippingConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shippingConfig,
        MethodConverter $methodConverter
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->shippingConfig = $shippingConfig;
        $this->methodConverter = $methodConverter;
    }

    /**
     * Return array of carriers with methods optgroup.
     * If $isActiveOnlyFlag is set to true, will return only active carriers
     *
     * @param bool $isActiveOnlyFlag
     * @return array
     */
    public function toOptionArray($isActiveOnlyFlag = false)
    {
        $methods = [];
        $carriers = $this->shippingConfig->getActiveCarriers();

        /** @var \Magento\Shipping\Model\Carrier\CarrierInterface $carrierModel */
        foreach ($carriers as $carrierCode => $carrierModel) {
            if (!$carrierModel->isActive() && (bool)$isActiveOnlyFlag === true) {
                continue;
            }

            $carrierMethods = $carrierModel->getAllowedMethods();

            if (!$carrierMethods) {
                continue;
            }

            $carrierTitle = $this->scopeConfig->getValue(
                'carriers/' . $carrierCode . '/title',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );

            if (empty($carrierTitle) || ctype_space($carrierTitle)) {
                $carrierTitle = $carrierCode;
            }

            $methods[$carrierCode] = ['label' => $carrierTitle, 'optgroup' => [], 'value' => $carrierCode];

            foreach ($carrierMethods as $methodCode => $methodTitle) {
                $methods
                    = $this->methodConverter->collectMethods($methodCode, $methodTitle, $carrierCode, $methods, true);
                    
            }
        }

        return $methods;
    }
}
