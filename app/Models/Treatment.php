<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', // ID pacjenta
        'dentist_id', // ID dentysty
        'treatment_name', // nazwa zabiegu
        'description', // opis zabiegu
        'price', // cena zabiegu
        'waiting_time'
    ];


    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}