<?php

namespace App\Test\Project\Context\UserModule\Client\Transformer;

use App\Project\Context\CommonInterfaces\Entity\EntityInterface;
use App\Project\Context\UserModule\Client\Transformer\ClientTransformer;
use App\Tests\UnitTester;
use Codeception\Test\Unit;
use Exception;
use UnexpectedValueException;

class ClientTransformerTest extends Unit
{
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

        $actual = $transformer->transform($this->tester->createClientEntityMock());

        $this->assertEquals($this->tester->getClientArray(), $actual);
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
     * @return ClientTransformer
     */
    private function createTransformer(): ClientTransformer
    {
        return new ClientTransformer();
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
