<?php



namespace Dww\CommonRules\Model\Modifiers;

/**
 * Interface ModifierInterface
 */
interface ModifierInterface
{
    /**
     * Modify Object
     * @param \Magento\Framework\DataObject $object
     * @return \Magento\Framework\DataObject
     */
    public function modify($object);
}
