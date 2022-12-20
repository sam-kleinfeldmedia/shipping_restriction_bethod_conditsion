<?php



namespace Dww\CommonRules\Model\Modifiers;

/**
 * Address Modifier
 */
class Address implements \Dww\CommonRules\Model\Modifiers\ModifierInterface
{
    /**
     * @param \Magento\Framework\DataObject $object
     * @param null $rateAddress
     * @return \Magento\Framework\DataObject
     */
    public function modify($object, $rateAddress = null)
    {
        if ($rateAddress) {
            $object->setData($object->getData() + $rateAddress->getData());
        }

        return $object;
    }
}
