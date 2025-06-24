<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'genre_id',
        'judul',
        'isi',
        'penulis',
        'gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}
