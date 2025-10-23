<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
