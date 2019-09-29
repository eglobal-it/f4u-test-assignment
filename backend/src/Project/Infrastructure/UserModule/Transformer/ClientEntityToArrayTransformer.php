<?php

namespace App\Project\Infrastructure\UserModule\Transformer;

use App\Project\Context\UserModule\Client\Entity\ClientEntityInterface;
use App\Project\Context\UserModule\UserContractInterface;
use App\Project\Infrastructure\Common\Transformer\TransformerInterface;

class ClientEntityToArrayTransformer implements TransformerInterface
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
     * @param ClientEntityInterface $data
     *
     * @inheritDoc
     */
    public function transform($data): array
    {
        return $this->userContract->transformClientToArray($data);
    }
}
