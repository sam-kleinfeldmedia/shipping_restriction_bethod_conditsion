<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

use Dww\CommonRules\Controller\Adminhtml\Rule\AbstractMassActions;

/**
 * Class MassAction
 */
class MassAction extends AbstractMassActions
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';
}
