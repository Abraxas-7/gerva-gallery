<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackSpot extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'description',
    ];

    // A TrackSpot belongs to a Location (renamed from track)
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
