<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

use Magento\Framework\Phrase;

/**
 * Edit action.
 */
class Edit extends \Dww\CommonRules\Controller\Adminhtml\Rule\AbstractEdit
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';

    protected $registryKey = \Dww\Shiprestriction\Model\ConstantsInterface::REGISTRY_KEY;

    /**
     * @return Phrase
     */
    protected function getDefaultTitle()
    {
        return __('Add new Shipping Restriction Rule');
    }

    /**
     * @param int $ruleId
     *
     * @return Phrase
     */
    protected function getErrorMessage($ruleId)
    {
        return __('Unable to load Shipping Restriction Rule with ID %1. Please review the log and try again.', $ruleId);
    }
}
