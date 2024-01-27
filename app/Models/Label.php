<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photos_metadata', 'label_id', 'photo_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'albums_metadata', 'label_id', 'album_id');
    }


}
