<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    // use SoftDeletes;

    protected $table = 'countries'; // Optional: Explicitly define the table name

    protected $fillable = [
        'shortname', // The short name of the country
        'name',      // The full name of the country
        'phonecode', // The international phone code
    ];

    // If you have relationships, you can define them here
    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
