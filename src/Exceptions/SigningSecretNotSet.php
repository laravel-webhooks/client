<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

use Exception;

class SigningSecretNotSet extends Exception
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('The signing secret is not set.');
    }
}
