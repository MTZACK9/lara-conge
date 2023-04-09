<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;
    public function personnes()
    {
        return $this->hasMany(Personne::class);
    }
}
