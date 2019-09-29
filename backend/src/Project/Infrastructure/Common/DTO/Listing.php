<?php

namespace App\Project\Infrastructure\Common\DTO;

class Listing
{
    /**
     * @var array
     */
    private $list;

    /**
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
