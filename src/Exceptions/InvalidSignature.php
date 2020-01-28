<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

class InvalidSignature extends BaseException
{
    /**
     * Constructor.
     *
     * @param string $message
     * @param string $signature
     *
     * @return void
     */
    public function __construct(string $message, string $signature)
    {
        if (! $message) {
            $message = 'The signature %s is invalid.';
        }

        parent::__construct(sprintf($message, $signature));
    }
}
