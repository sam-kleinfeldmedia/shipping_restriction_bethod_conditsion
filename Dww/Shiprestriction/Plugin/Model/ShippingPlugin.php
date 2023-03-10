<?php

namespace Dww\Shiprestriction\Plugin\Model;

use Dww\Shiprestriction\Model\ConstantsInterface;

/**
 * Entry point.
 */
class ShippingPlugin
{
    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory
     */
    private $rateErrorFactory;

    /**
     * @var \Dww\Shiprestriction\Model\ShippingRestrictionRule
     */
    private $shippingRestrictionRule;

    /**
     * @var \Dww\CommonRules\Model\Config
     */
    private $commonRulesConfig;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateRequest|null
     */
    private $request = null;

    public function __construct(
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Dww\Shiprestriction\Model\ShippingRestrictionRule $shipRestrictionRule,
        \Dww\CommonRules\Model\Config $commonRulesConfig
    ) {
        $this->rateErrorFactory = $rateErrorFactory;
        $this->shippingRestrictionRule = $shipRestrictionRule;
        $this->commonRulesConfig = $commonRulesConfig;
    }

    public function beforeCollectRates(
        \Magento\Shipping\Model\Shipping $subject,
        \Magento\Quote\Model\Quote\Address\RateRequest $request
    ) {
        $this->request = $request;
    }

    public function afterCollectRates(\Magento\Shipping\Model\Shipping $subject, $result)
    {
        $result = $subject->getResult();

        if (!($rates = $result->getAllRates())
            || !($rules = $this->shippingRestrictionRule->getRestrictionRules($this->request))
        ) {
            return $subject;
        }

        $result->reset();
        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $rate */
        foreach ($rates as $rate) {
            $restrict = false;
            /** @var \Dww\Shiprestriction\Model\Rule $rule */
            foreach ($rules as $rule) {
                if ($rule->match($rate)) {
                    $restrict = true;
                    $this->setError($result, $rate, $rule->getMessage());
                    break;
                }
            }
            if (!$restrict) {
                $result->append($rate);
            }

        }

        return $subject;
    }

    /**
     * @param \Magento\Shipping\Model\Rate\Result $result
     * @param \Magento\Quote\Model\Quote\Address\RateResult\Method $lastRate
     * @param string $errorMessage
     *
     * @return bool
     */
    private function setError($result, $lastRate, $errorMessage)
    {
        $errorMessage = $errorMessage
            ?: __('Sorry, no shipping quotes are available for the selected products and destination');

        $isShowMessage = $this->commonRulesConfig->getErrorMessageConfig(
            ConstantsInterface::SECTION_KEY
        );

        if ($lastRate !== null && $isShowMessage && $errorMessage) {
            $error = $this->rateErrorFactory->create();
            $error->setCarrier($lastRate->getCarrier());
            $error->setCarrierTitle($lastRate->getCarrierTitle());
            $error->setErrorMessage($errorMessage);

            $result->append($error);

            return true;
        }

        return false;
    }
}
