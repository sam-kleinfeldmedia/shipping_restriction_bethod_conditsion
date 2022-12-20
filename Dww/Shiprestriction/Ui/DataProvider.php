<?php

namespace Dww\Shiprestriction\Ui;

use Dww\Shiprestriction\Model\ResourceModel\Rule\Collection;
use Dww\Shiprestriction\Model\ResourceModel\Rule\CollectionFactory;
use Dww\Shiprestriction\Model\Rule;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var Rule $rule */
        foreach ($items as $rule) {
            $this->loadedData[$rule->getId()] = $rule->prepareForEdit()->getData();
        }

        if ($data = $this->dataPersistor->get(\Dww\Shiprestriction\Model\ConstantsInterface::DATA_PERSISTOR_FORM)) {
            $rule = $this->collection->getNewEmptyItem();
            $rule->setData($data);
            $this->loadedData[$rule->getId()] = $rule->getData();
            $this->dataPersistor->clear(\Dww\Shiprestriction\Model\ConstantsInterface::DATA_PERSISTOR_FORM);
        }

        return $this->loadedData;
    }
}
