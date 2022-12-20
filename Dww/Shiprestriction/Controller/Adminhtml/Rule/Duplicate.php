<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Duplicate Action
 */
class Duplicate extends \Dww\CommonRules\Controller\Adminhtml\Rule\AbstractDuplicate
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';
}
