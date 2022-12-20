<?php



namespace Dww\Shiprestriction\Test\Unit\Model;

use Dww\Shiprestriction\Model\Rule;
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
     * @var Rule
     */
    private $model;

    protected function setUp(): void
    {
        $this->model = $this->createPartialMock(Rule::class, []);
    }

    /**
     * @covers Rule::prepareForEdit
     */
    public function testPrepareForEdit()
    {
        $this->model->setData('stores', 12);
        $this->model->setData('cust_groups', [15]);
        $this->model->setCarriers('test');
        $this->model->prepareForEdit();
        $this->assertEquals(['test', ''], $this->model->getMethods());
    }

    /**
     * @covers Rule::getStores
     */
    public function testGetStores()
    {
        $this->model->setData('stores', '1, 2, 3');
        $this->assertEquals([1, 2, 3], $this->model->getStores());
    }

    /**
     * @covers Rule::setStores
     */
    public function testSetStores()
    {
        $this->model->setStores([1, 2, 3]);
        $this->assertEquals('1,2,3', $this->model->getData('stores'));
    }
}