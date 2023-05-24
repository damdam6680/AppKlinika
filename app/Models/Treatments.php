<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatments extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', // ID pacjenta
        'dentist_id', // ID dentysty
        'treatment_name', // nazwa zabiegu
        'description', // opis zabiegu
        'price', // cena zabiegu

    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }
}
