<?php

namespace App\Test\Project\Context\UserModule;

use App\Project\Context\UserModule\Client\ClientServiceInterface;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use App\Project\Context\UserModule\UserContract;
use App\Tests\UnitTester;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Exception;

class UserContractTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetClientById(): void
    {
        $contract = $this->createContract('getClientById');

        $actual = $contract->getClientById($this->tester->getClientId());

        $this->assertInstanceOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testFindClients(): void
    {
        $contract = $this->createContract('findClients');

        $actual = $contract->findClients();

        $this->assertContainsOnlyInstancesOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testTransformClientToArray(): void
    {
        $contract = $this->createContract('transformClientToArray');

        $actual = $contract->transformClientToArray($this->tester->createClientEntityMock());

        $this->assertEquals($this->tester->getClientArray(), $actual);
    }

    /**
     * @param string $methodName
     *
     * @return UserContract
     * @throws Exception
     */
    private function createContract(string $methodName): UserContract
    {
        return new UserContract($this->createService($methodName));
    }

    /**
     * @param string $methodName
     *
     * @return ClientServiceInterface
     * @throws Exception
     */
    private function createService(string $methodName): ClientServiceInterface
    {
        $methods = [
            'findClientById' => Expected::once($this->tester->createClientEntityMock()),
            'findClients' => Expected::once([$this->tester->createClientEntityMock()]),
            'transformClientToArray' => Expected::once($this->tester->getClientArray()),
        ];

        /** @var ClientServiceInterface $mock */
        $mock = $this->makeEmpty(
            ClientServiceInterface::class,
            array_intersect_key($methods, array_fill_keys([$methodName], 0))
        );

        return $mock;
    }
}
