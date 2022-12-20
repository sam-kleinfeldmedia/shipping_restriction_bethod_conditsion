<?php



namespace Dww\CommonRules\Model\Rule\Factory;

use Dww\CommonRules\Model\Rule\Condition\ConditionBuilder as Conditions;

/**
 * Class HandleFactory
 */
class HandleFactory extends HandlerFactoryAbstract
{
    /**
     * HandleFactory constructor.
     * @param array $handlers
     */
    public function __construct(
        array $handlers
    ) {
        $this->handlers = $handlers;
    }

    /**
     * @param string $type
     * @return array
     */
    protected function getConditionsByType($type)
    {
        $typeCode = ucfirst($type);
        $conditions = [];

        if ($condition = $this->getHandlerByType($type)) {
            $conditionAttributes = $condition->loadAttributeOptions()->getAttributeOption();

            $attributes = [];
            foreach ($conditionAttributes as $code => $label) {
                $attributes[] = [
                    'value' => Conditions::dWW_COMMON_RULES_PATH_TO_CONDITIONS . $typeCode . '|' . $code,
                    'label' => $label,
                ];
            }

            $conditions[] = [
                'value' => $attributes,
                'label' => $condition->getConditionLabel(),
            ];
        }

        return $conditions;
    }
}
