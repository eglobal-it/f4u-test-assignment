<?php

namespace App\Tests\Project\Context\DeliveryModule\Address\DTO;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\DeliveryModule\Address\DTO\CreateAddress;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;

class CreateAddressTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetClient(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getClient();

        $this->assertInstanceOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetZipCode(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getZipCode();

        $this->assertEquals($this->tester->getAddressZipCode(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetCountry(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getCountry();

        $this->assertEquals($this->tester->getAddressCountry(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetCity(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getCity();

        $this->assertEquals($this->tester->getAddressCity(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetStreet(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getStreet();

        $this->assertEquals($this->tester->getAddressStreet(), $actual);
    }

    /**
     * @return CreateAddress
     *
     * @throws Exception
     */
    private function createDTO(): CreateAddress
    {
        $address = $this->tester->createAddressEntityMock([
            'getClient',
            'getZipCode',
            'getCountry',
            'getCity',
            'getStreet'
        ]);

        return new CreateAddress(
            $address->getClient(),
            $address->getZipCode(),
            $address->getCountry(),
            $address->getCity(),
            $address->getStreet()
        );
    }
}
