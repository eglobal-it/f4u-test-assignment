<?php

namespace App\Test\Project\Context\DeliveryModule;

use App\Project\Context\DeliveryModule\Address\AddressServiceInterface;
use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\DeliveryModule\DeliveryContract;
use App\Tests\UnitTester;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Exception;

class DeliveryContractTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetAddressById(): void
    {
        $contract = $this->createContract('getAddressById');

        $actual = $contract->getAddressById($this->tester->getAddressId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testFindAddressesByClientId(): void
    {
        $contract = $this->createContract('findAddressesByClientId');

        $actual = $contract->findAddressesByClientId($this->tester->getClientId());

        $this->assertContainsOnlyInstancesOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testCreateAddress(): void
    {
        $contract = $this->createContract('createAddress');

        $actual = $contract->createAddress($this->createDTOCreateAddress());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testUpdateAddress(): void
    {
        $contract = $this->createContract('updateAddress');

        $actual = $contract->updateAddress($this->createDTOUpdateAddress());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetDefaultAddressByClientId(): void
    {
        $contract = $this->createContract('getDefaultAddressByClientId');

        $actual = $contract->getDefaultAddressByClientId($this->tester->getClientId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetDefaultAddressById(): void
    {
        $contract = $this->createContract('setDefaultAddressById');

        $actual = $contract->setDefaultAddressById($this->tester->getAddressId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testDeleteAddressById(): void
    {
        $contract = $this->createContract('deleteAddressById');

        $actual = $contract->deleteAddressById($this->tester->getAddressId());

        $this->assertTrue($actual);
    }

    /**
     * @throws Exception
     */
    public function testTransformAddressToArray(): void
    {
        $contract = $this->createContract('transformAddressToArray');

        $actual = $contract->transformAddressToArray($this->tester->createAddressEntityMock());

        $this->assertEquals($this->tester->getAddressArray(), $actual);
    }

    /**
     * @param string $methodName
     *
     * @return DeliveryContract
     * @throws Exception
     */
    private function createContract(string $methodName): DeliveryContract
    {
        return new DeliveryContract($this->createService($methodName));
    }

    /**
     * @param string $methodName
     *
     * @return AddressServiceInterface
     * @throws Exception
     */
    private function createService(string $methodName): AddressServiceInterface
    {
        $methods = [
            'getAddressById' => Expected::once($this->tester->createAddressEntityMock()),
            'findAddressesByClientId' => Expected::once([$this->tester->createAddressEntityMock()]),
            'createAddress' => Expected::once($this->tester->createAddressEntityMock()),
            'updateAddress' => Expected::once($this->tester->createAddressEntityMock()),
            'setDefaultAddressById' => Expected::once($this->tester->createAddressEntityMock()),
            'deleteAddressById' => Expected::once(true),
            'transformAddressToArray' => Expected::once($this->tester->getAddressArray()),
        ];

        /** @var AddressServiceInterface $mock */
        $mock = $this->makeEmpty(
            AddressServiceInterface::class,
            array_intersect_key($methods, array_fill_keys([$methodName], 0))
        );

        return $mock;
    }


    /**
     * @return CreateAddress
     *
     * @throws Exception
     */
    private function createDTOCreateAddress(): CreateAddress
    {
        /** @var CreateAddress $mock */
        $mock = $this->makeEmpty(CreateAddress::class, [
            'getClient' => $this->tester->createClientEntityMock(),
            'getZipCode' => $this->tester->getAddressZipCode(),
            'getCountry' => $this->tester->getAddressCountry(),
            'getCity' => $this->tester->getAddressCity(),
            'getStreet' => $this->tester->getAddressStreet(),
        ]);

        return $mock;
    }

    /**
     * @return UpdateAddress
     *
     * @throws Exception
     */
    private function createDTOUpdateAddress(): UpdateAddress
    {
        /** @var UpdateAddress $mock */
        $mock = $this->makeEmpty(UpdateAddress::class, [
            'getAddressId' => $this->tester->getAddressId(),
            'getZipCode' => $this->tester->getAddressZipCode(),
            'getCountry' => $this->tester->getAddressCountry(),
            'getCity' => $this->tester->getAddressCity(),
            'getStreet' => $this->tester->getAddressStreet(),
        ]);

        return $mock;
    }
}
