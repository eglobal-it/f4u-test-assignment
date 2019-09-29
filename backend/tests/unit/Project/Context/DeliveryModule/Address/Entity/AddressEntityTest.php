<?php

namespace App\Tests\Project\Context\DeliveryModule\Address\Entity;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;

class AddressEntityTest extends Unit
{
    /**
     * @var int
     */
    private $newClientId = 2;

    /**
     * @var int
     */
    private $newZipCode = '12055-3560';

    /**
     * @var int
     */
    private $newCountry = 'USA';

    /**
     * @var int
     */
    private $newCity = 'New York';

    /**
     * @var int
     */
    private $newStreet = 'Lincoln';

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetId(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getId();

        $this->assertEquals($this->tester->getAddressId(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetClient(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getClient();

        $this->assertInstanceOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetClient(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setClient($this->tester->createClient($this->newClientId));

        $this->assertEquals($this->tester->createClient($this->newClientId), $entity->getClient());
    }

    /**
     * @throws Exception
     */
    public function testGetZipCode(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getZipCode();

        $this->assertEquals($this->tester->getAddressZipCode(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetZipCode(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setZipCode($this->newZipCode);

        $this->assertEquals($this->newZipCode, $entity->getZipCode());
    }

    /**
     * @throws Exception
     */
    public function testGetCountry(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getCountry();

        $this->assertEquals($this->tester->getAddressCountry(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetCountry(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setCountry($this->newCountry);

        $this->assertEquals($this->newCountry, $entity->getCountry());
    }

    /**
     * @throws Exception
     */
    public function testGetCity(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getCity();

        $this->assertEquals($this->tester->getAddressCity(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetCity(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setCity($this->newCity);

        $this->assertEquals($this->newCity, $entity->getCity());
    }

    /**
     * @throws Exception
     */
    public function testGetStreet(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->getStreet();

        $this->assertEquals($this->tester->getAddressStreet(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetStreet(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setStreet($this->newStreet);

        $this->assertEquals($this->newStreet, $entity->getStreet());
    }

    /**
     * @throws Exception
     */
    public function testIsDefault(): void
    {
        $entity = $this->tester->createAddressEntity();

        $actual = $entity->isDefault();

        $this->assertEquals($this->tester->isAddressIsDefaultFalse(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetIsDefault(): void
    {
        $entity = $this->tester->createAddressEntity();

        $entity->setIsDefault($this->tester->isAddressIsDefaultTrue());

        $this->assertEquals($this->tester->isAddressIsDefaultTrue(), $entity->isDefault());
    }
}
