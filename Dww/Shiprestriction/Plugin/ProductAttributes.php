<?php



namespace Dww\Shiprestriction\Plugin;

/**
 * Class ProductAttributes
 * phpcs:ignoreFile
 */
class ProductAttributes extends \Dww\CommonRules\Plugin\ProductAttributes
{
    /**
     * ProductAttributes constructor.
     * @param \Dww\Shiprestriction\Model\ResourceModel\Rule $resourceTable
     */
    public function __construct(\Dww\Shiprestriction\Model\ResourceModel\Rule $resourceTable)
    {
        parent::__construct($resourceTable);
    }
}
