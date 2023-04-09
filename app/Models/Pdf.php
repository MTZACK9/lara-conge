<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'personne_id',
        'nomAr',
        'prenomAr',
        'dateDebut',
        'dateFin',
        'grade',
        'lieuResidence',
        'lieuConge',
        'tele',
        'annee',
        'periode',
        'valeur',
        'duree'
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}
