<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

class SigningKeyConfigNotFound extends BaseException
{
    /**
     * Constructor.
     *
     * @param string $signingKey
     *
     * @return void
     */
    public function __construct(string $signingKey)
    {
        parent::__construct(sprintf('The configuration for the `%s` signing key was not found.', $signingKey));
    }
}
