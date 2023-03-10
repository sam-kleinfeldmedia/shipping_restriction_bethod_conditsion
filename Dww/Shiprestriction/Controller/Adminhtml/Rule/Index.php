<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Grid.
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';

    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Dww_Shiprestriction::rule');
        $resultPage->getConfig()->getTitle()->prepend(__('Shipping Restrictions'));
        $resultPage->addBreadcrumb(__('Shipping Restrictions'), __('Shipping Restrictions'));

        return $resultPage;
    }
}
