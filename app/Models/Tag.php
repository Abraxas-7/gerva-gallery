<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'tag_category_id'];

    public function category()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_tag');
    }
}
