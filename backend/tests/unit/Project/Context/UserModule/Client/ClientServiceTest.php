<?php

namespace App\Test\Project\Context\UserModule\Client;

use App\Project\Context\UserModule\Client\ClientService;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use App\Project\Context\UserModule\Client\Repository\ClientRepositoryInterface;
use App\Project\Context\UserModule\Client\Transformer\ClientTransformerInterface;
use App\Tests\UnitTester;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Exception;

class ClientServiceTest extends Unit
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
        $service = $this->createService('findClientById');

        $actual = $service->getClientById($this->tester->getClientId());

        $this->assertInstanceOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testFindClients(): void
    {
        $service = $this->createService('findClients');

        $actual = $service->findClients();

        $this->assertContainsOnlyInstancesOf(ClientEntityInterface::class, $actual);
    }

    /**
     * @throws Exception
     */
    public function testTransformClientToArray(): void
    {
        $service = $this->createService('transform');

        $actual = $service->transformClientToArray($this->tester->createClientEntityMock());

        $this->assertEquals($this->tester->getClientArray(), $actual);
    }

    /**
     * @param string $methodName
     *
     * @return ClientService
     *
     * @throws Exception
     */
    private function createService(string $methodName): ClientService
    {
        return new ClientService($this->createRepository($methodName), $this->createTransformer($methodName));
    }

    /**
     * @param string $methodName
     *
     * @return ClientRepositoryInterface
     *
     * @throws Exception
     */
    private function createRepository(string $methodName): ClientRepositoryInterface
    {
        $methods = [
            'findClientById' => Expected::once($this->tester->createClientEntityMock()),
            'findClients' => Expected::once([$this->tester->createClientEntityMock()]),
        ];

        /** @var ClientRepositoryInterface $mock */
        $mock = $this->makeEmpty(
            ClientRepositoryInterface::class,
            array_intersect_key($methods, array_fill_keys([$methodName], 0))
        );

        return $mock;
    }

    /**
     * @param string $methodName
     *
     * @return ClientTransformerInterface
     *
     * @throws Exception
     */
    private function createTransformer(string $methodName): ClientTransformerInterface
    {
        $methods = [
            'transform' => Expected::once($this->tester->getClientArray()),
        ];

        /** @var ClientTransformerInterface $mock */
        $mock = $this->makeEmpty(
            ClientTransformerInterface::class,
            array_intersect_key($methods, array_fill_keys([$methodName], 0))
        );

        return $mock;
    }
}
