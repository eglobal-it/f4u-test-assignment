<?php

namespace App\Tests;

use Codeception\Util\HttpCode;

class ClientCest
{
    /**
     * @param ApiTester $tester
     */
    public function clientListing(ApiTester $tester)
    {
        $tester->sendGET('/api/v1/client');

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => [
                'list' => [
                    $this->clientJsonType()
                ],
            ]
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function clientGet(ApiTester $tester)
    {
        $tester->sendGET('/api/v1/client/1');

        $tester->seeResponseCodeIs(HttpCode::OK);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'SUCCESS',
        ]);

        $tester->seeResponseMatchesJsonType([
            'data' => $this->clientJsonType()
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function clientGetNotFound(ApiTester $tester)
    {
        $tester->sendGET('/api/v1/client/9999999999999999999');

        $tester->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'NOT_FOUND',
        ]);
    }

    /**
     * @param ApiTester $tester
     */
    public function clientGetValidationError(ApiTester $tester)
    {
        $tester->sendGET('/api/v1/client/0');

        $tester->seeResponseCodeIs(HttpCode::BAD_REQUEST);

        $tester->seeResponseIsJson();

        $tester->seeResponseContainsJson([
            'code' => 'VALIDATE_ERROR',
        ]);

        $tester->seeResponseMatchesJsonType([
            'errors' => [
                'clientId' => 'string'
            ]
        ]);
    }

    /**
     * @return array
     */
    private function clientJsonType(): array
    {
        return [
            'id' => 'integer',
            'first_name' => 'string',
            'last_name' => 'string',
        ];
    }
}
