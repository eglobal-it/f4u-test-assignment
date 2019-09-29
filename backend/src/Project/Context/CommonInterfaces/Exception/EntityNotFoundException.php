<?php

namespace App\Project\Context\CommonInterfaces\Exception;

use Exception;

class EntityNotFoundException extends Exception
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $messageTemplate = "Entity '%s' was not found.";

    /**
     * @param string $class
     *
     * @return EntityNotFoundException
     */
    public function setClass(string $class): EntityNotFoundException
    {
        $this->class = $class;
        $this->message = sprintf($this->messageTemplate, $this->class);

        return $this;
    }
}
