<?php



namespace Dww\CommonRules\Model\Rule\Condition\Product;

use Dww\CommonRules\Model\Rule\Condition\ConditionBuilder as Conditions;

/**
 * Class Combine
 */
class Combine extends \Magento\SalesRule\Model\Rule\Condition\Product\Combine
{
    /**
     * @var Conditions
     */
    private $conditionBuilder;

    /**
     * Combine constructor.
     * @param \Magento\Rule\Model\Condition\Context $context
     * @param \Dww\CommonRules\Model\Rule\Condition\Product $ruleConditionProduct
     * @param Conditions $conditionBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        \Dww\CommonRules\Model\Rule\Condition\Product $ruleConditionProduct,
        \Dww\CommonRules\Model\Rule\Condition\ConditionBuilder $conditionBuilder,
        array $data = []
    ) {
        $this->conditionBuilder = $conditionBuilder;
        parent::__construct($context, $ruleConditionProduct, $data);
        $this->setType(Conditions::dWW_COMMON_RULES_PATH_TO_CONDITIONS . 'Product\Combine');
    }

    /**
     * @return array
     */
    public function getNewChildSelectOptions()
    {
        $conditions = parent::getNewChildSelectOptions();

        return $this->conditionBuilder->getChangedNewChildSelectOptions($conditions);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $model
     * @return bool
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        $items = $model->getAllItems();

        if ($items) {
            foreach ($items as $item) {
                if (!parent::validate($item)) {
                    return false;
                }
            }
        }

        return parent::validate($model);
    }
}
