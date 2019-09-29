<?php
namespace App\Tests;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntity;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntityInterface;
use App\Project\Context\UserModule\Client\Entity\ClientEntity;
use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use Codeception\Actor;
use Codeception\Stub\Expected;
use Codeception\Test\Feature\Stub;
use Exception;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends Actor
{
    use _generated\UnitTesterActions, Stub;

    /**
     * @var int
     */
    private $clientId = 10;

    /**
     * @var string
     */
    private $clientFirstName = 'FirstName';

    /**
     * @var string
     */
    private $clientLastName = 'LastName';

    /**
     * @var int
     */
    private $addressId = 1;

    /**
     * @var string
     */
    private $addressZipCode = '623620';

    /**
     * @var string
     */
    private $addressCountry = 'RussianFederation';

    /**
     * @var string
     */
    private $addressCity = 'Moscow';

    /**
     * @var string
     */
    private $addressStreet = 'Lenin';

    /**
     * @var bool
     */
    private $addressIsDefaultTrue = true;

    /**
     * @var bool
     */
    private $addressIsDefaultFalse = false;

    /**
     * @param int|null $id
     *
     * @return ClientEntity
     *
     * @throws Exception
     */
    public function createClient(?int $id = null): ClientEntity
    {
        $entity = new ClientEntity();

        $entity->setFirstName($this->getClientFirstName());
        $entity->setLastName($this->getClientLastName());

        $reflection = new ReflectionClass(ClientEntity::class);

        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $id ?: $this->getClientId());

        return $entity;
    }

    /**
     * @return ClientEntityInterface
     *
     * @throws Exception
     */
    public function createClientEntityMock(): ClientEntityInterface
    {
        /** @var ClientEntityInterface $mock */
        $mock = $this->makeEmpty(ClientEntityInterface::class, [
            'getId' => Expected::once($this->clientId),
            'getFirstName' => Expected::once($this->clientFirstName),
            'getLastName' => Expected::once($this->clientLastName),
        ]);

        return $mock;
    }

    /**
     * @return AddressEntity
     *
     * @throws Exception
     */
    public function createAddressEntity(): AddressEntity
    {
        $entity = new AddressEntity();

        $entity->setClient($this->createClient());
        $entity->setZipCode($this->getAddressZipCode());
        $entity->setCountry($this->getAddressCountry());
        $entity->setCity($this->getAddressCity());
        $entity->setStreet($this->getAddressStreet());
        $entity->setIsDefault($this->isAddressIsDefaultFalse());

        $reflection = new ReflectionClass(AddressEntity::class);

        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($entity, $this->getAddressId());

        return $entity;
    }

    /**
     * @return AddressEntity
     *
     * @throws Exception
     */
    public function createAddressEntityDefault(): AddressEntity
    {
        return $this->createAddressEntity()->setIsDefault($this->isAddressIsDefaultTrue());
    }

    /**
     * @param array $methods
     *
     * @return AddressEntityInterface
     *
     * @throws Exception
     */
    public function createAddressEntityMock(array $methods = []): AddressEntityInterface
    {
        $entityMethods = [
            'getId' => Expected::once($this->addressId),
            'getClient' => Expected::once($this->createClient()),
            'getZipCode' => Expected::once($this->addressZipCode),
            'getCountry' => Expected::once($this->addressCountry),
            'getCity' => Expected::once($this->addressCity),
            'getStreet' => Expected::once($this->addressStreet),
            'isDefault' => Expected::once($this->addressIsDefaultTrue),
        ];

        /** @var AddressEntityInterface $mock */
        $mock = $this->makeEmpty(
            AddressEntityInterface::class,
            array_intersect_key($entityMethods, array_fill_keys($methods, 0))
        );

        return $mock;
    }

    /**
     * @return array
     */
    public function getClientArray(): array
    {
        return [
            'id' => $this->clientId,
            'first_name' => $this->clientFirstName,
            'last_name' => $this->clientLastName,
        ];
    }

    /**
     * @return array
     */
    public function getAddressArray(): array
    {
        return [
            'id' => $this->addressId,
            'zip_code' => $this->addressZipCode,
            'country' => $this->addressCountry,
            'city' => $this->addressCity,
            'street' => $this->addressStreet,
            'is_default' => $this->addressIsDefaultTrue,
        ];
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientFirstName(): string
    {
        return $this->clientFirstName;
    }

    /**
     * @return string
     */
    public function getClientLastName(): string
    {
        return $this->clientLastName;
    }

    /**
     * @return int
     */
    public function getAddressId(): int
    {
        return $this->addressId;
    }

    /**
     * @return string
     */
    public function getAddressZipCode(): string
    {
        return $this->addressZipCode;
    }

    /**
     * @return string
     */
    public function getAddressCountry(): string
    {
        return $this->addressCountry;
    }

    /**
     * @return string
     */
    public function getAddressCity(): string
    {
        return $this->addressCity;
    }

    /**
     * @return string
     */
    public function getAddressStreet(): string
    {
        return $this->addressStreet;
    }

    /**
     * @return bool
     */
    public function isAddressIsDefaultTrue(): bool
    {
        return $this->addressIsDefaultTrue;
    }

    /**
     * @return bool
     */
    public function isAddressIsDefaultFalse(): bool
    {
        return $this->addressIsDefaultFalse;
    }
}
