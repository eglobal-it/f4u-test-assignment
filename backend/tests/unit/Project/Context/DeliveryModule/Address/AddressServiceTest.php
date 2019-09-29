<?php

namespace App\Test\Project\Context\DeliveryModule\Address;

use App\Project\Context\DeliveryModule\Address\AddressService;
use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\DeliveryModule\Address\Exception\AttemptToRemoveDefaultAddressException;
use App\Project\Context\DeliveryModule\Address\Exception\MaxCountAddressesException;
use App\Project\Context\DeliveryModule\Address\Repository\AddressRepositoryInterface;
use App\Project\Context\DeliveryModule\Address\Transformer\AddressTransformerInterface;
use App\Tests\UnitTester;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Exception;

class AddressServiceTest extends Unit
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
        $service = $this->createService(['getAddressById']);

        $actual = $service->getAddressById($this->tester->getAddressId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function findAddressesByClientId(): void
    {
        $service = $this->createService(['findAddressesByClientId']);

        $actual = $service->findAddressesByClientId($this->tester->getAddressId());

        $this->assertContainsOnlyInstancesOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testCreateAddress(): void
    {
        $service = $this->createService(['findCountAddressByClientId', 'save']);

        $actual = $service->createAddress($this->createDTOCreateAddress());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testCreateAddressMaxCountAddressesException(): void
    {
        $service = $this->createService(['findCountAddressByClientId'], 3);

        $this->expectException(MaxCountAddressesException::class);

        $service->createAddress($this->createDTOCreateAddress());
    }

    /**
     * @throws Exception
     */
    public function testUpdateAddress(): void
    {
        $service = $this->createService(['findAddressById', 'save']);

        $actual = $service->updateAddress($this->createDTOUpdateAddress());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetDefaultAddressByClientId(): void
    {
        $service = $this->createService(['getDefaultAddressByClientId']);

        $actual = $service->getDefaultAddressByClientId($this->tester->getClientId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetDefaultAddressById(): void
    {
        $service = $this->createService(['setDefaultAddressById']);

        $actual = $service->setDefaultAddressById($this->tester->getAddressId());

        $this->assertInstanceOf(AddressEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testDeleteAddressById(): void
    {
        $service = $this->createService(['findAddressById', 'delete']);

        $actual = $service->deleteAddressById($this->tester->getAddressId());

        $this->assertTrue($actual);
    }

    /**
     * @throws Exception
     */
    public function testDeleteAddressByIdAttemptToRemoveDefaultAddressException(): void
    {
        $service = $this->createService(['findAddressById'], 3, true);

        $this->expectException(AttemptToRemoveDefaultAddressException::class);

        $service->deleteAddressById($this->tester->getAddressId());
    }

    /**
     * @throws Exception
     */
    public function testTransformAddressToArray(): void
    {
        $service = $this->createService(['transform']);

        $actual = $service->transformAddressToArray($this->createAddressEntityMock());

        $this->assertEquals($this->tester->getAddressArray(), $actual);
    }

    /**
     * @param string[] $methodNames
     * @param int $countAddresses
     * @param bool $isDefault
     *
     * @return AddressService
     * @throws Exception
     */
    private function createService(array $methodNames, int $countAddresses = 1, bool $isDefault = false): AddressService
    {
        return new AddressService(
            $this->createRepository($methodNames, $countAddresses, $isDefault),
            $this->createTransformer($methodNames)
        );
    }

    /**
     * @param string[] $methodNames
     * @param int $countAddresses
     * @param bool $isDefault
     *
     * @return AddressRepositoryInterface
     * @throws Exception
     */
    private function createRepository(
        array $methodNames,
        int $countAddresses = 1,
        bool $isDefault = false
    ): AddressRepositoryInterface {
        $methods = [
            'save' => Expected::once(true),
            'delete' => Expected::once(true),
            'findAddressById' => Expected::once($this->createAddressEntityMock($isDefault)),
            'findAddressesByClientId' => Expected::once([$this->tester->createAddressEntityMock()]),
            'findCountAddressByClientId' => Expected::once($countAddresses),
            'findDefaultAddressByClientId' => Expected::once($this->tester->createAddressEntityMock()),
            'setDefaultAddressById' => Expected::once($this->tester->createAddressEntityMock()),
        ];

        /** @var AddressRepositoryInterface $mock */
        $mock = $this->makeEmpty(
            AddressRepositoryInterface::class,
            array_intersect_key($methods, array_fill_keys($methodNames, 0))
        );

        return $mock;
    }

    /**
     * @param string[] $methodNames
     *
     * @return AddressTransformerInterface
     *
     * @throws Exception
     */
    private function createTransformer(array $methodNames): AddressTransformerInterface
    {
        $methods = [
            'transform' => Expected::once($this->tester->getAddressArray()),
        ];

        /** @var AddressTransformerInterface $mock */
        $mock = $this->makeEmpty(
            AddressTransformerInterface::class,
            array_intersect_key($methods, array_fill_keys($methodNames, 0))
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

    /**
     * @param bool $isDefault
     *
     * @return AddressEntityInterface
     * @throws Exception
     */
    public function createAddressEntityMock(bool $isDefault = false): AddressEntityInterface
    {
        /** @var AddressEntityInterface $mock */
        $mock = $this->makeEmpty(AddressEntityInterface::class, [
            'isDefault' => $isDefault
        ]);

        return $mock;
    }
}
