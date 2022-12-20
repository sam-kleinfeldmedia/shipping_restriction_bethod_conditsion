<?php



namespace Dww\CommonRules\Model\Validator;

/**
 * Interface ModifierInterface
 */
interface ValidatorInterface
{
    /**
     * @param \Magento\Rule\Model\AbstractModel $rule
     * @param \Magento\Quote\Model\Quote\Item[] $items
     *
     * @return boolean
     */
    public function validate($rule, $items);
}
