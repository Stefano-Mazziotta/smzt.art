<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'slug',
        'thumbnail'
    ];

     public function photos()
    {
        return $this->belongsToMany(Photo::class, 'albums_photos', 'album_id','photo_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'albums_metadata', 'album_id', 'label_id');
    }
}
