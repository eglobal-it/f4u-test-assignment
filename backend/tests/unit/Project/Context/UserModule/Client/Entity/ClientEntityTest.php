<?php

namespace App\Tests\Project\Context\UserModule\Client\Entity;

use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;

class ClientEntityTest extends Unit
{
    /**
     * @var string
     */
    private $newFirstName = 'New FirstName';

    /**
     * @var string
     */
    private $newLastName = 'New LastName';

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetId(): void
    {
        $entity = $this->tester->createClient();

        $actual = $entity->getId();

        $this->assertEquals($this->tester->getClientId(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testGetFirstName(): void
    {
        $entity = $this->tester->createClient();

        $actual = $entity->getFirstName();

        $this->assertEquals($this->tester->getClientFirstName(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetFirstName(): void
    {
        $entity = $this->tester->createClient();

        $entity->setFirstName($this->newFirstName);

        $this->assertEquals($entity->getFirstName(), $this->newFirstName);
    }

    /**
     * @throws Exception
     */
    public function testGetLastName(): void
    {
        $entity = $this->tester->createClient();

        $actual = $entity->getLastName();

        $this->assertEquals($this->tester->getClientLastName(), $actual);
    }

    /**
     * @throws Exception
     */
    public function testSetLastName(): void
    {
        $entity = $this->tester->createClient();

        $entity->setLastName($this->newLastName);

        $this->assertEquals($entity->getLastName(), $this->newLastName);
    }
}
