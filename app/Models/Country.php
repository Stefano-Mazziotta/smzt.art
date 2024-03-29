<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function locations()
    {
        return $this->hasMany(Location::class,'country_id');
    }

    public function cameras()
    {
        return $this->hasMany(Camera::class,'country_id');
    }
}
