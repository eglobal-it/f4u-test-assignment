<?php

namespace App\Project\Infrastructure\Common\Transformer;

use App\Project\Infrastructure\Common\DTO\Listing;

class ListingTransformer implements TransformerInterface
{
    /**
     * @var TransformerInterface
     */
    private $itemTransformer;

    /**
     * @param TransformerInterface $itemTransformer
     */
    public function __construct(TransformerInterface $itemTransformer)
    {
        $this->itemTransformer = $itemTransformer;
    }

    /**
     * @param Listing $data
     *
     * @return array
     */
    public function transform($data): array
    {
        return ['list' => array_map(function ($data) {
            return $this->itemTransformer->transform($data);
        }, $data->getList())];
    }
}
