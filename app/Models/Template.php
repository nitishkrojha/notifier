<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $visible = [
        'id',
        'created_at',
        'updated_at',
        'client_id',
        'name',
        'text',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeForClient($query, Client $client)
    {
        return $query->where('client_id', $client->id);
    }
}
