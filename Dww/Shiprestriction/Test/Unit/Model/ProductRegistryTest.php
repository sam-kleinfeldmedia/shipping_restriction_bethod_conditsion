<?php



namespace Dww\Shiprestriction\Test\Unit\Model;

use Dww\Shiprestriction\Model\ProductRegistry;
use Dww\Shiprestriction\Test\Unit\Traits;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class ProductRegistryTest
 *
 * @see ProductRegistry
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class ProductRegistryTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @covers ProductRegistry::_beforeSave
     */
    public function testAddProduct()
    {
        $model = $this->getObjectManager()->getObject(ProductRegistry::class);
        $model->addProduct('test1');
        $model->addProduct('test2');
        $this->assertEquals(['test1', 'test2'], $model->getProducts());
        $model->addProduct('test1');
        $this->assertEquals(['test1', 'test2'], $model->getProducts());
    }
}
