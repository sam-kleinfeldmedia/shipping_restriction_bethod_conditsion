<?php



namespace Dww\Shiprestriction\Test\Unit\Model\ResourceModel;

use Dww\Shiprestriction\Model\ResourceModel\Rule;
use Dww\Shiprestriction\Test\Unit\Traits;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class RuleTest
 *
 * @see Rule
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class RuleTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @covers Rule::_beforeSave
     */
    public function testBeforeSave()
    {
        $model = $this->getObjectManager()->getObject(Rule::class);
        $object = $this->createPartialMock(\Magento\Framework\Model\AbstractModel::class, []);
        $object->setData('stores', [15]);
        $object->setData('methods', ['test']);

        $this->invokeMethod($model, '_beforeSave', [$object]);
        $this->assertEquals('test', $object->getCarriers());
    }
}
