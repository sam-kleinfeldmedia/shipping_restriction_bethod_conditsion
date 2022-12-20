<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Action of Rule creating.
 */
class NewAction extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';

    public function execute()
    {
        $this->_forward('edit');
    }
}
