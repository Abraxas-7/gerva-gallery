<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'path',
        'watermark_path',
        'event_id',
        'location_id',
        'track_spot_id',
        'taken_at',
        'description',
        'published',
    ];

    protected $casts = [
        'taken_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function trackSpot()
    {
        return $this->belongsTo(TrackSpot::class);
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class, 'photo_request');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'photo_tag');
    }
}
