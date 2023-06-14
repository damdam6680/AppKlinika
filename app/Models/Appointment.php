<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'dentist_id',
        'treatmets_id',
        'visit_date',
        'visit_time',
        'description',
        'price'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatmets_id');
    }
    public function dentist()
    {
        return $this->belongsTo(Dentist::class, 'dentist_id');
    }

}
