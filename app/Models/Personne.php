<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'nomAr',
        'prenomAr',
        'grade_id',
        'division_id',
        'service_id',
        'anneeD'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function conges()
    {
        return $this->hasMany(Conger::class);
    }
    public function pdfs()
    {
        return $this->hasMany(Pdf::class);
    }
}
