<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conger extends Model
{
    use HasFactory;

    protected $fillable = [
        'personne_id',
        'dateDebut',
        'dateFin',
        'lieuResidence',
        'lieuConge',
        'tele',
        'annee',
        'periode',
        'valeur',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}
