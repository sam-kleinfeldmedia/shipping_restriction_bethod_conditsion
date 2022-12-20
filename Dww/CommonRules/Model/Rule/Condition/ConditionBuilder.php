<?php



namespace Dww\CommonRules\Model\Rule\Condition;

/**
 * Class ConditionBuilder
 */
class ConditionBuilder
{
    const dWW_COMMON_RULES_PATH_TO_CONDITIONS = 'Dww\CommonRules\Model\Rule\Condition\\';
    const AMASTY_SHIP_RESTRICTION_PATH_TO_CONDITIONS = 'Amasty\Shiprestriction\Model\Rule\Condition\\';
    const AMASTY_SHIP_RULES_PATH_TO_CONDITIONS = 'Amasty\Shiprules\Model\Rule\Condition\\';
    const MAGENTO_SALES_RULE_PATH_TO_CONDITIONS = 'Magento\SalesRule\Model\Rule\Condition\\';

    /**
     * @param $conditions
     * @return array
     */
    public function getChangedNewChildSelectOptions($conditions)
    {
        foreach ($conditions as $key => $value) {
            if (isset($value['value'])
                && $value['value'] == self::MAGENTO_SALES_RULE_PATH_TO_CONDITIONS . 'Product\Combine'
            ) {
                $conditions[$key]['value'] = self::dWW_COMMON_RULES_PATH_TO_CONDITIONS . 'Product\Combine';
            }
        }

        return $conditions;
    }
}
