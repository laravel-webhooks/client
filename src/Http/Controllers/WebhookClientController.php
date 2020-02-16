<?php

declare(strict_types=1);

namespace LaravelWebhooks\Client\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use LaravelWebhooks\Client\Models\WebhookReceived;

abstract class WebhookClientController extends Controller
{
    /**
     * The Illuminate Http Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Handles the Webhook call.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $this->request = $request;

        $this->validateRequest();

        if ($this->shouldProcess()) {
            $webhook = $this->storeWebhook();

            $this->dispatchJob($webhook);
        }

        $date = (string) Carbon::now();

        return new Response("Webhook received at {$date}", Response::HTTP_OK);
    }

    /**
     * Handles the storing of the webhook on the database.
     *
     * @return \LaravelWebhooks\Client\Models\WebhookReceived
     */
    public function storeWebhook(): WebhookReceived
    {
        return WebhookReceived::create($this->getPayloadForSave());
    }

    /**
     * Returns the payload for saving the data into the database.
     *
     * @return array
     */
    public function getPayloadForSave(): array
    {
        return [
            'type'    => $this->getWebhookType(),
            'payload' => $this->request->input(),
        ];
    }

    /**
     * Performs validation on the request payload.
     *
     * @throws \LaravelWebhooks\Client\Exceptions\InvalidRequest
     *
     * @return void
     */
    abstract public function validateRequest(): void;

    /**
     * Returns the webhook type or event name.
     *
     * @return string
     */
    abstract public function getWebhookType(): string;

    /**
     * Returns the defined jobs.
     *
     * @return array
     */
    abstract public function getDefinedJobs(): array;

    /**
     * Determines if the request should be processed.
     *
     * @return bool
     */
    public function shouldProcess(): bool
    {
        $type = $this->getWebhookType();

        $jobs = $this->getDefinedJobs();

        return array_key_exists($type, $jobs) && class_exists($jobs[$type]);
    }

    /**
     * Dispatches the job for the Webhook, if the job class is defined and found.
     *
     * @param \LaravelWebhooks\Client\Models\WebhookReceived $webhook
     *
     * @return void
     */
    public function dispatchJob(WebhookReceived $webhook): void
    {
        $type = $webhook->type;

        $jobs = $this->getDefinedJobs();

        if (array_key_exists($type, $jobs) && class_exists($jobs[$type])) {
            $jobClassName = $jobs[$type];

            dispatch(new $jobClassName($webhook));
        }
    }
}
