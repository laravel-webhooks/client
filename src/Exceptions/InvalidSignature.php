<?php

namespace LaravelWebhooks\Client\Exceptions;

class InvalidSignature extends BaseException
{
    /**
     * Constructor.
     *
     * @param string $signature
     *
     * @return void
     */
    public function __construct(string $signature)
    {
        parent::__construct("The signature {$signature} is invalid.");
    }
}
