<?php

namespace App\Test\Project\Context\DeliveryModule\Address\Transformer;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;
use App\Project\Context\DeliveryModule\Address\Transformer\AddressTransformer;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;
use UnexpectedValueException;

class AddressTransformerTest extends Unit
{
    /**
     * @var array
     */
    private $methods = ['getId', 'getZipCode', 'getCountry', 'getCity', 'getStreet', 'isDefault'];

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testTransform(): void
    {
        $transformer = $this->createTransformer();

        $actual = $transformer->transform($this->tester->createAddressEntityMock($this->methods));

        $this->assertEquals($this->tester->getAddressArray(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testTransformException(): void
    {
        $transformer = $this->createTransformer();

        $this->expectException(UnexpectedValueException::class);

        $transformer->transform($this->createFakeEntity());
    }

    /**
     * @return AddressTransformer
     */
    private function createTransformer(): AddressTransformer
    {
        return new AddressTransformer();
    }

    /**
     * @return EntityInterface
     *
     * @throws Exception
     */
    private function createFakeEntity(): EntityInterface
    {
        /** @var EntityInterface $mock */
        $mock = $this->makeEmpty(EntityInterface::class);

        return $mock;
    }
}
