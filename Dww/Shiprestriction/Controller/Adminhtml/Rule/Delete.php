<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Delete action
 */
class Delete extends \Dww\CommonRules\Controller\Adminhtml\Rule\AbstractDelete
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';
}
