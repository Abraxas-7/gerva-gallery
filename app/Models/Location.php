<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'description',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function trackSpots()
    {
        return $this->hasMany(TrackSpot::class);
    }
}
