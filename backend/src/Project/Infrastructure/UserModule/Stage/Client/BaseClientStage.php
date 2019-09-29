<?php

namespace App\Project\Infrastructure\UserModule\Stage\Client;

use App\Project\Context\UserModule\UserContractInterface;
use League\Pipeline\StageInterface;

abstract class BaseClientStage implements StageInterface
{
    /**
     * @var UserContractInterface
     */
    private $userContract;

    /**
     * @param UserContractInterface $userContract
     */
    public function __construct(UserContractInterface $userContract)
    {
        $this->userContract = $userContract;
    }

    /**
     * @return UserContractInterface
     */
    protected function getUserContract(): UserContractInterface
    {
        return $this->userContract;
    }
}
