<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'client_id',
        'event_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Foto selezionate nella richiesta
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_request');
    }
}
