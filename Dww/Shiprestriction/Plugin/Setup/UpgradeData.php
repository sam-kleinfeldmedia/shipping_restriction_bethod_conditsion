<?php

namespace Dww\Shiprestriction\Plugin\Setup;

/**
 * Converting serialized rule data to JSON.
 */
class UpgradeData
{
    /**
     * @var \Dww\Shiprestriction\Setup\SerializedFieldDataConverter
     */
    private $fieldDataConverter;

    public function __construct(\Dww\Shiprestriction\Setup\SerializedFieldDataConverter $fieldDataConverter)
    {
        $this->fieldDataConverter = $fieldDataConverter;
    }

    /**
     * @param \Magento\SalesRule\Setup\UpgradeData $subject
     * @param $result
     * @return mixed
     */
    public function afterConvertSerializedDataToJson(\Magento\SalesRule\Setup\UpgradeData $subject, $result)
    {
        $this->fieldDataConverter->convertSerializedDataToJson(
            'dww_shiprestriction_rule',
            'rule_id',
            ['conditions_serialized']
        );

        return $result;
    }
}
