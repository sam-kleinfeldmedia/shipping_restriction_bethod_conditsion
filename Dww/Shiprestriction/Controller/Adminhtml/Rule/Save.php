<?php



namespace Dww\Shiprestriction\Controller\Adminhtml\Rule;

/**
 * Class Save
 */
class Save extends \Dww\CommonRules\Controller\Adminhtml\Rule\AbstractSave
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dww_Shiprestriction::rule';

    protected $dataPersistorKey = \Dww\Shiprestriction\Model\ConstantsInterface::DATA_PERSISTOR_FORM;

    protected function prepareData(&$data)
    {
        if (isset($data['rule_id'])) {
            unset($data['rule_id']);
        }

        if (isset($data['rule']['conditions'])) {
            $data['conditions'] = $data['rule']['conditions'];
        }

        unset($data['rule']);
    }
}
