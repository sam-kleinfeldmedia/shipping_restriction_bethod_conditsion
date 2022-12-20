<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Class for getting html of selected Condition.
 */
class NewConditionHtml extends \Dww\CommonRules\Controller\Adminhtml\Rule\AbstractCondition
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';

    public function execute()
    {
        $this->newConditions('conditions');
    }
}
