<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class BaseException extends HttpException
{
    /**
     * Constructor.
     *
     * @param string $message
     * @param int    $code
     *
     * @return void
     */
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($code, $message);
    }
}
