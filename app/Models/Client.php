<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'notes',
    ];

    /**
     * Le richieste fatte dal cliente
     */
    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
