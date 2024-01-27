<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'coordinates', 'country_id'];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function photos()
    {
        return $this->hasMany(Photo::class,'film_id');
    }
}
