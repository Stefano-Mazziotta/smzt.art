<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $fillable = ['country_id', 'name', 'production_year'];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class,'film_id');
    }
}
