<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function puisis()
    {
        return $this->hasMany(Puisi::class);
    }
}
