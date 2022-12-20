<?php



namespace Dww\Shiprestriction\Model\Rule\Condition;

/**
 * Class Address
 */
class Address extends \Dww\CommonRules\Model\Rule\Condition\Address
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadAttributeOptions()
    {
        parent::loadAttributeOptions();

        $attributes = $this->getAttributeOption();
        unset($attributes['shipping_method']);
        $this->setAttributeOption($attributes);

        return $this;
    }
}
