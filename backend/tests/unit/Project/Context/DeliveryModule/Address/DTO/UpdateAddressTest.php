<?php

namespace App\Tests\Project\Context\DeliveryModule\Address\DTO;

use App\Project\Context\DeliveryModule\Address\DTO\UpdateAddress;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;

class UpdateAddressTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetAddressId(): void
    {
        $dto = $this->createDTO();

        $actual = $dto->getAddressId();

        $this->assertEquals($this->tester->getAddressId(), $actual);
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
     * @return UpdateAddress
     *
     * @throws Exception
     */
    private function createDTO(): UpdateAddress
    {
        $address = $this->tester->createAddressEntityMock([
            'getId',
            'getZipCode',
            'getCountry',
            'getCity',
            'getStreet'
        ]);

        return new UpdateAddress(
            $address->getId(),
            $address->getZipCode(),
            $address->getCountry(),
            $address->getCity(),
            $address->getStreet()
        );
    }
}
