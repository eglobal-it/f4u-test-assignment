<?php

namespace App\Project\Infrastructure\UserModule\Stage\Client;

use App\Project\Infrastructure\Common\DTO\Listing;

class GetListing extends BaseClientStage
{
    /**
     * @inheritDoc
     *
     * @param mixed $payload
     *
     * @return Listing
     */
    public function __invoke($payload): Listing
    {
        return new Listing($this->getUserContract()->findClients());
    }
}
