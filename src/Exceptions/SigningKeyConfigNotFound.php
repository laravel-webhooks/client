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
        parent::__construct(sprintf('The signing key `%s` configuration was not found.', $signingKey));
    }
}
