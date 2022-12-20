<?php

namespace Dww\Shiprestriction\Model\ResourceModel\Rule;

/**
 * Class Collection
 */
class Collection extends \Dww\CommonRules\Model\ResourceModel\Rule\Collection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Dww\Shiprestriction\Model\Rule::class,
            \Dww\Shiprestriction\Model\ResourceModel\Rule::class
        );
    }
}
