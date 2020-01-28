<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

class InvalidRequest extends BaseException
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('The request is invalid or the payload that was sent is not in a valid format.');
    }
}
