<?php

namespace LaravelWebhooks\Client\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookReceived extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'webhooks_received';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'payload',
        'exception',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payload'   => 'json',
        'exception' => 'json',
    ];
}
