<?php



namespace Dww\CommonRules\Model\Rule\Condition;

/**
 * Factory for @see \Dww\CommonRules\Model\Rule\Condition\Combine;
 */
class CombineFactory extends \Magento\SalesRule\Model\Rule\Condition\CombineFactory
{
    /**
     * CombineFactory constructor.
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        $instanceName = ConditionBuilder::dWW_COMMON_RULES_PATH_TO_CONDITIONS . 'Combine'
    ) {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }
}
