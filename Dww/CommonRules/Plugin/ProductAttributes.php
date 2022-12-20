<?php



namespace Dww\CommonRules\Plugin;

/**
 * Class ProductAttributes
 */
abstract class ProductAttributes
{
    /**
     * @var null
     */
    private $resourceTable;

    public function __construct($resourceTable = null)
    {
        $this->resourceTable = $resourceTable;
    }

    /**
     * @param \Magento\Quote\Model\Quote\Config $subject
     * @param array $attributesTransfer
     * @return array|mixed
     */
    public function afterGetProductAttributes(\Magento\Quote\Model\Quote\Config $subject, $attributesTransfer)
    {
        $attributes = $this->resourceTable->getAttributes();

        foreach ($attributes as $code) {
            $attributesTransfer[] = $code;
        }

        return $attributesTransfer;
    }
}
