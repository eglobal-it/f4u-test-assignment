<?php

namespace App\Tests;

use App\Project\Context\DeliveryModule\Address\Entity\AddressEntity;
use App\Project\Context\UserModule\Client\Entity\ClientEntity;
use Codeception\Util\HttpCode;

class AddressCest
{
    /**
     * @param ApiTester $tester
     */
    public function addressListing(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);

        $tester->sendGET("/api/v1/client/$clientId/address");

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => [
                'list' => [
                    $this->addressJsonType()
                ],
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addressListingNotFound(ApiTester $tester)
    {
        $tester->sendGET("/api/v1/client/9999999999999999999/address");

        $tester->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'NOT_FOUND',
        ]);

        $tester->seeResponseMatchesJsonType([
            'message' => 'string'
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addressListingNoValid(ApiTester $tester)
    {
        $tester->sendGET("/api/v1/client/0/address");

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'clientId' => 'string',
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     *
     * @after addTwoAddress
     */
    public function addressGet(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId);

        $tester->sendGET("/api/v1/client/{$clientId}/address/{$addressId}");

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);
    }

    /**
     * @param ApiTester $tester
     *
     * @after addTwoAddress
     */
    public function addressGetNotFound(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $tester->sendGET("/api/v1/client/{$clientId}/address/99999999999");

        $tester->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'NOT_FOUND',
        ]);

        $tester->seeResponseMatchesJsonType([
            'message' => 'string'
        ]);
    }


    /**
     * @param ApiTester $tester
     *
     * @after addTwoAddress
     */
    public function addressGetValidationError(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $tester->sendGET("/api/v1/client/{$clientId}/address/0");

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'addressId' => 'string'
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addFirstAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddress($tester, $clientId);

        $tester->seeResponseCodeIs(HttpCode::CREATED);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'CREATED',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => true],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addTwoAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);

        $tester->seeResponseCodeIs(HttpCode::CREATED);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'CREATED',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => false],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addTreeAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);

        $tester->seeResponseCodeIs(HttpCode::CREATED);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'CREATED',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => false],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addFourAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);
        $this->createAddress($tester, $clientId);

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'INTERNAL_ERROR',
        ]);

        $tester->seeResponseContainsJson([
            'message' => 'Exceeded maximum address count',
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function addAddressNoValid(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);
        $tester->sendPOST("/api/v1/client/$clientId/address", []);

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'zipCode' => 'string',
                'country' => 'string',
                'city' => 'string',
                'street' => 'string',
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function updateAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId);

        $data = [
            'zip_code' => $tester->getFaker()->postcode,
            'country' => $tester->getFaker()->country,
            'city' => $tester->getFaker()->city,
            'street' => $tester->getFaker()->streetName,
        ];

        $tester->sendPUT("/api/v1/client/$clientId/address/{$addressId}", $data);

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => $data,
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function updateAddressNoValid(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId);

        $data = [
            'zip_code' => '',
            'country' => '',
            'city' => '',
            'street' => '',
        ];

        $tester->sendPUT("/api/v1/client/$clientId/address/0", $data);

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'addressId' => 'string',
                'zipCode' => 'string',
                'country' => 'string',
                'city' => 'string',
                'street' => 'string',
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function deleteAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $this->createAddressRepository($tester, $clientId);
        $addressId = $this->createAddressRepository($tester, $clientId, false);

        $tester->sendDELETE("/api/v1/client/$clientId/address/{$addressId}");

        $tester->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    /**
     * @param ApiTester $tester
     */
    public function deleteAddressNotDeleteDefault(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId);

        $tester->sendDELETE("/api/v1/client/$clientId/address/{$addressId}");

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'INTERNAL_ERROR',
        ]);

        $tester->seeResponseContainsJson([
            'message' => 'Deleting the default address is prohibited',
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function deleteAddressNoFound(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $tester->sendDELETE("/api/v1/client/$clientId/address/999999999999999999");

        $tester->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'NOT_FOUND',
        ]);

        $tester->seeResponseMatchesJsonType([
            'message' => 'string'
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function deleteAddressNoValid(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $tester->sendDELETE("/api/v1/client/$clientId/address/0");

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'addressId' => 'string',
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function setDefaultAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $defaultAddressId = $this->createAddressRepository($tester, $clientId);

        $addressId = $this->createAddressRepository($tester, $clientId, false);

        $tester->sendPUT("/api/v1/client/$clientId/address/{$addressId}/default");

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => true],
        ]);

        $tester->sendGET("/api/v1/client/$clientId/address/{$defaultAddressId}");

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => false],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function setDefaultAddressNotChangeOld(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId, false);

        $tester->sendPUT("/api/v1/client/$clientId/address/{$addressId}/default");

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => true],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function getDefaultAddress(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $addressId = $this->createAddressRepository($tester, $clientId, true);

        $tester->sendGET("/api/v1/client/$clientId/address/default");

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->addressJsonType()
        ]);

        $tester->seeResponseContainsJson([
            'data' => ['is_default' => true],
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function getDefaultAddressNotFound(ApiTester $tester)
    {
        $clientId = $this->createClient($tester);

        $tester->sendGET("/api/v1/client/$clientId/address/default");

        $tester->seeResponseCodeIs(HttpCode::INTERNAL_SERVER_ERROR);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'INTERNAL_ERROR',
        ]);

        $tester->seeResponseContainsJson([
            'message' => 'Default Address Not Found',
        ]);
    }

    /**
     * @return array
     */
    private function addressJsonType(): array
    {
        return [
            'id' => 'integer',
            'zip_code' => 'string',
            'country' => 'string',
            'city' => 'string',
            'street' => 'string',
            'is_default' => 'boolean',
        ];
    }

    /**
     * @param ApiTester $tester
     *
     * @return int
     */
    private function createClient(ApiTester $tester): int
    {
        return $tester->haveInRepository(ClientEntity::class, [
            'firstName' => $tester->getFaker()->firstName,
            'lastName' => $tester->getFaker()->lastName,
        ]);
    }

    /**
     * @param ApiTester $tester
     * @param int $clientId
     * @param bool $isDefault
     *
     * @return int
     */
    private function createAddressRepository(ApiTester $tester, int $clientId, bool $isDefault = true): int
    {
        return $tester->haveInRepository(AddressEntity::class, [
            'client' => $tester->grabEntityFromRepository(ClientEntity::class, ['id' => $clientId]),
            'zipCode' => $tester->getFaker()->postcode,
            'country' => $tester->getFaker()->country,
            'city' => $tester->getFaker()->city,
            'street' => $tester->getFaker()->streetName,
            'isDefault' => $isDefault
        ]);
    }

    /**
     * @param ApiTester $tester
     * @param int $clientId
     */
    private function createAddress(ApiTester $tester, int $clientId): void
    {
        $tester->haveHttpHeader('Content-Type', 'application/json');
        $tester->sendPOST("/api/v1/client/{$clientId}/address", [
            'zip_code' => $tester->getFaker()->postcode,
            'country' => $tester->getFaker()->country,
            'city' => $tester->getFaker()->city,
            'street' => $tester->getFaker()->streetName
        ]);
    }
}
