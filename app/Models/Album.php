<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';

    protected $fillable = [
        'artist_id',
        'name',
        'sales',
        'date_released',
        'last_update',
        'image',
        'created_at',
        'updated_at',
    ];

    public function artist()
    {
        return $this->belongsTo(Album::class, 'artist_id', 'id');
    }
}
