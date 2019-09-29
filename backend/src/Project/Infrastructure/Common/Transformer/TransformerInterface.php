<?php

namespace App\Project\Infrastructure\Common\Transformer;

interface TransformerInterface
{
    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function transform($data);
}
