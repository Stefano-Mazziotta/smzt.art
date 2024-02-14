<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        'camera_id',
        'film_id',
        'title',
        'description',
        'width',
        'height',
        'path'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function camera()
    {
        return $this->belongsTo(Camera::class, 'camera_id');
    }
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'albums_photos', 'photo_id', 'album_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'photos_metadata', 'photo_id', 'label_id');
    }
}
