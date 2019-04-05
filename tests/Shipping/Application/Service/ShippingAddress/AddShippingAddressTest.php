<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 21:59
 */
namespace F4u\Tests\Shipping\Application\Service\ShippingAddress\AddShippingAddress;


use Doctrine\Common\Collections\ArrayCollection;
use F4u\Shipping\Application\Service\ShippingAddress\AddShippingAddress;
use F4u\Shipping\Application\Service\ShippingAddress\DataTransformer\JsonShippingAddressDataTransformer;
use F4u\Shipping\Application\Service\ShippingAddress\ShippingAddressParameters;
use F4u\Shipping\Domain\Model\Client\Client;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\ShippingAddress\Address;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddress;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Infrastructure\Persistence\InMemory\Repository\InMemoryClientRepository;
use F4u\Shipping\Infrastructure\Persistence\InMemory\Repository\InMemoryShippingAddressRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * @property JsonShippingAddressDataTransformer transformer
 * @property InMemoryShippingAddressRepository  addrRepo
 * @property InMemoryClientRepository           clientRepo
 * @property Address                            address1
 * @property Address                            address2
 * @property Client                             client
 * @property ShippingAddress                    shippingAddress
 * @property Client                             clientWithAddresses
 */
class AddShippingAddressTest extends TestCase
{
    protected function setUp(): void
    {
        $this->address1 = new Address('LV-1020', 'Rigas', 'Riga', 'LV');
        $this->address2 = new Address('RU-1020', 'Maskavas', 'Maskava', 'RU');
        $this->client = new Client(new ClientId('without-stored-addresses'), 'Test', 'Testov');
        $this->shippingAddress = ShippingAddress::factory(
            new ShippingAddressId('existing'),
            $this->client,
            $this->address2,
            true
        );
        $this->clientWithAddresses = new Client(
            new ClientId('with-address'),
            'Test2',
            'Testov2',
            new ArrayCollection([$this->shippingAddress])
        );

        $this->transformer = new JsonShippingAddressDataTransformer();
        $this->addrRepo = new InMemoryShippingAddressRepository();

        $this->clientRepo = new InMemoryClientRepository();
        $this->clientRepo->save($this->client);
        $this->clientRepo->save($this->clientWithAddresses);
    }

    /**
     * @param bool $default
     *
     * @dataProvider provideForTestAdding
     */
    public function testAddingFirst($default)
    {
        $this->addrRepo->setNextIdentity('new');
        (new AddShippingAddress($this->clientRepo, $this->addrRepo, $this->transformer))->run(
            new ClientId('without-stored-addresses'),
            new ShippingAddressParameters($this->address1, $default)
        );
        $this->assertEquals(
            '{"shipping_address_uuid":"new","client_uuid":"without-stored-addresses",' .
            '"is_default":true,"zipcode":"LV-1020",' .
            '"street":"Rigas","city":"Riga","country":"LV"}',
            $this->transformer->read()
        );
        $this->addrRepo->reset();
    }

    public function provideForTestAdding()
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @param bool $default
     *
     * @dataProvider provideForTestAdding
     */
    public function testAddingNotFirst($default)
    {
        $this->addrRepo->save($this->shippingAddress);

        $this->addrRepo->setNextIdentity('new');
        (new AddShippingAddress($this->clientRepo, $this->addrRepo, $this->transformer))->run(
            new ClientId('with-address'),
            new ShippingAddressParameters($this->address1, $default)
        );
        $this->assertEquals(
            '{"shipping_address_uuid":"new","client_uuid":"with-address",' .
            '"is_default":' . ($default ? 'true' : 'false') . ',"zipcode":"LV-1020",' .
            '"street":"Rigas","city":"Riga","country":"LV"}',
            $this->transformer->read()
        );

        $this->addrRepo->reset();
    }
}