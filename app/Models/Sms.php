<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Sms\Status;
use App\Sms\Service;

class Sms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $visible = [
        'id',
        'created_at',
        'updated_at',
        'client_id',
        'template_id',
        'provider_id',
        'provider_sender_id',
        'status',
        'num_attempts',
        'phone',
        'text',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => Status::PENDING,
        'num_attempts' => 0,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function scopeForClient($query, Client $client)
    {
        return $query->where('client_id', $client->id);
    }

    public function getProviderId(): string
    {
        return $this->provider_id ?? $this->client->sms_provider_id;
    }

    public function getProviderSenderId(): string
    {
        return $this->provider_sender_id ?? Service::getProviderById($this->getProviderId())::getDefaultSenderId();
    }
}
