<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

abstract class BaseException extends \Exception
{
    /**
     * Constructor.
     *
     * @param string $message
     *
     * @return void
     */
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
