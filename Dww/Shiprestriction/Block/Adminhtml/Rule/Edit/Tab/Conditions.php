<?php

namespace Dww\Shiprestriction\Block\Adminhtml\Rule\Edit\Tab;

use Dww\Shiprestriction\Model\ConstantsInterface;
use Dww\CommonRules\Block\Adminhtml\Rule\Edit\Tab\Conditions as CommonRulesCondition;

/**
 * Conditions Fieldset
 */

class Conditions extends CommonRulesCondition
{
    const FORM_NAME = 'amasty_ship_rule_form';

    public function _construct()
    {
        $this->setRegistryKey(ConstantsInterface::REGISTRY_KEY);
        parent::_construct();
    }

    /**
     * @inheritdoc
     */
    protected function formInit($model)
    {
        $form = $this->_formFactory->create();
        $renderer = $this->rendererFieldset->setTemplate(
            'Dww_Shiprestriction::ui/conditions/fieldset.phtml'
        )->setFieldSetId(self::RULE_CONDITIONS_FIELDSET_NAMESPACE)->setNewChildUrl(
            $this->getUrl(
                'dww_shiprestriction/rule/newConditionHtml',
                ['form' => self::FORM_NAME, 'form_namespace' => self::RULE_CONDITIONS_FIELDSET_NAMESPACE]
            )
        );

        $fieldset = $form->addFieldset(
            self::RULE_CONDITIONS_FIELDSET_NAMESPACE,
            [
                'legend' => __(
                    'Apply the rule only if the following conditions are met (leave blank for all products).'
                ),
                // @codingStandardsIgnoreStart
                'comment' => 'Check our <a target="_blank" title="User Guide" href="' . $guidLink .
                    '">user guide</a> to set the conditions properly. Also,  <a target="_blank" title="Blog Post" '
                    . 'href="' . $postLink . '">this post</a> in our blog will help you to avoid common mistakes.'
                // @codingStandardsIgnoreEnd
            ]
        )->setRenderer(
            $renderer
        );

        $fieldset->addField(
            'conditions',
            'text',
            [
                'name' => 'conditions',
                'label' => __('Conditions'),
                'title' => __('Conditions'),
                'data-form-part' => self::FORM_NAME
            ]
        )->setRule(
            $model
        )->setRenderer(
            $this->conditions
        );

        $this->setConditionFormName(
            $model->getConditions(),
            self::RULE_CONDITIONS_FIELDSET_NAMESPACE,
            self::FORM_NAME
        );

        return $form;
    }
}
